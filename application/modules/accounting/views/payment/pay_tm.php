Redirecting to PayTM....
<html>
<head>
    <script type="text/javascript">       
        function submit_pay_tm() {          
           document.forms.pay_tm.submit();           
        }
    </script>
</head>
<body onload="submit_pay_tm()">
    <form action="<?php echo PAYTM_TXN_URL ?>" method="post" name="pay_tm">
        <?php
            foreach($param_lists as $name => $value) {
                echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
            }
	?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $check_sum; ?>">
    </form>
</body>
</html>
