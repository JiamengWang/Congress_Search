<?php 
    function request($m)
    {
        $key ="apikey=892b8a20125b4c64b3bc1674fc38df53";
        $domain_sc = "http://104.198.0.197:8080/";
        $domain_sun = "https://congress.api.sunlightfoundation.com/";
        $leg =$domain_sc."legislators?order=state_asc,last_name_asc&per_page=all&".$key."";
//        $leg = "https://congress.api.sunlightfoundation.com/legislators?".$key."&per_page=all";
        $bill=$domain_sc."bills?".$key."";
        $communit=$domain_sc."committees?".$key."";
        $page_all = "&per_page=all";
        $page_num = "&per_page=50";
        $active_bill = "&history.active=true";
        $new_bill = "&history.active=false";
        $detail_committee = "&member_ids=";
        $detail_bill = "&sponsor_id=";
        if($m=="1")//get all legislators
        {
            $output = file_get_contents($leg,false);
//            $output = file_get_contents("leg.json");
            
        }
        else if($m=="2")//get fifty active bills
        {
            $output = file_get_contents($bill."".$page_num."".$active_bill,false);
//            $output = file_get_contents("bills.json");
        }
        else if($m=="3")//get all committees
        {
            $output = file_get_contents($communit."".$page_all,false);
//            $output = file_get_contents("comm.json");
        }
        else if($m=="4")//get fifty new bills
        {
            $output = file_get_contents($bill."".$page_num."".$new_bill,false);
//            $output = file_get_contents("bills.json");
        }
        else if($m=="5")//get legislator bills
        {
            $output = file_get_contents($bill."".$detail_bill."".$_GET["sponsorId"]."&per_page=5",false);
        }
        else if($m=="6")//get legislator community
        {
            $output = file_get_contents($communit."".$detail_committee."".$_GET["member_id"]."&per_page=5",false);
//            return $commit."".$detail_committee."".$_GET["member_id"];
        }
        return $output;
//        https://congress.api.sunlightfoundation.com/bills?sponsor.id=A000371&apikey=892b8a20125b4c64b3bc1674fc38df53
    }
    if(isset($_GET["mode"]))
    {
        $json = request($_GET["mode"]);
        echo $_GET['callback'].'('.json_encode($json).')';
    }

?>