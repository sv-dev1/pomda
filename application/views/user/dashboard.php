
<!-- section start  -->
<div class="container-fluid token" id="particles-js">
  <div class="container zindex">
    <div class="row">
      <div class="col-md-9 col-xs-12 ">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="left_left full_left">
              <h3><?php echo $this->lang->line("token");?></h3>
              <div class="bunny">
                <h1 data-attr="<?php echo (!empty($calculatebunny))?$calculatebunny[0]->Total:"0";?>"><?php  echo (!empty($calculatebunny))?number_format($calculatebunny[0]->Total ,2, '.', ''):"0";?> KICK</h1>
                <span>~<?php  echo (!empty($calculatebunny))?($calculatebunny[0]->Total * (get_data_by_id('total_supply','title','1Bunny','supply'))):"0";?> ETH</span>
                <span id="btc">~0 BTC</span>
                <span id="usd">~0 USD</span> 
              </div>
              <ul class="big_btnn">
                <li>
                  <button class="pop" type="button" data-toggle="modal" data-target="#myModal">Ethereum</button>
                </li>
                <li class="sec_btn">
                  <button class="pop" type="button" data-toggle="modal" data-target="#myModalbitcoin">Bitcoin</button></li>
                </ul>
                <div class="contract-info1">
                  <span>KICK Smart Contract Address</span>
                  <i class="fa fa-info"  data-toggle="modal" data-target="#myModal11"></i>
                </div>
  </div>
</div>
<div class="col-md-6 col-xs-12">
  <?php date_default_timezone_get();
  $date1=strtotime(date('Y/m/d'));
  $date2=strtotime('2018/06/08');
        // echo $date1; 
        // echo $date2;
      //  if(($date1) == $date2){  ?>
      <div class="right_right full_left">
        <span>Current price</span>
        <h1 class="changes_bunny">1ETH = <?php echo number_format(get_data_by_id('total_supply','title','1ETH','supply'),'2','.','');?>KICK</h1>
        <!-- <span></span> -->
        <!-- <img src="<?php echo site_url() ?>images/time.png" class="img-responsive" /> -->
      <?php //echo date_default_timezone_get();
       //echo date('Y/m/d h:i:s', time()+86400);
      ?>
      <span id='timer'>
        <div class="countdown-box">
          <div class="token-countdown d-flex align-content-stretch animated" data-zone="<?php echo date_default_timezone_get();?>" data-animate="fadeInUp" data-delay="2.05" data-date="<?php echo date('Y/m/d', time()+86400);?>">
          </div> 

		  </div>               
        </span>



      </br>
    </br>
  </br>

  <span>Raised</span>
  <h1 class="raised"><?php echo ($data_raised[0]->Total!=''?number_format($data_raised[0]->Total,'2','.',''):'0');?> ETH</h1>
  <br>
  <!--            <span>BUNNY Smart Contract Address</span> -->

</div>
<?php //} ?>

</div>
</div>
</div>
<div class="col-md-3 col-xs-12 pad">
  <div class="right_four">
    <button><a href="<?php echo base_url();?>assets/whitepaper_0.2.pdf" target="_blank" style="color: #26379f;">Whitepaper</a></button>
  </div>
</div>


</div>

<div class="row">
  <div class="col-md-9 col-xs-12 ">
    <div class="left_eight full_left">
      <h1>History</h1>

      <?php if(!empty($result)){?>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Transaction</th>
            <th>Date</th>
            <th>value</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $result1) {?>
          <tr>
            <td>
              <?php if($result1->type == 'eth'){?>
              <a href="http://ropsten.etherscan.io/tx/<?php echo $result1->transaction_hash;?>" target="_blank"><?php echo $result1->transaction_hash;?></a>
              <?php }else{?>
              <a href="https://blockchain.info/tx/<?php echo $result1->transaction_hash;?>" target="_blank"><?php echo $result1->transaction_hash;?></a>
              <?php }?>    
            </td>
            <td><?php echo $result1->date;?></td>
            <td>+<?php echo $result1->bunny;?>  KICK</td>
            <td><?php echo ($result1->status==1)?'succcess':'bonus';?></td>

          </tr>

          <?php }}else{?>
          <span>Here you transaction history will be shown</span>

          <?php } ?>



        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-3 col-xs-12 pad">
    <div class="right_four">
      <div class="video-preview">
        <img src="<?php echo site_url() ?>images/back.jpg" class="img-responsive" />

        <a href="#"> <div class="custum_test" id="video_prv">                         
          <img src="<?php echo site_url() ?>images/youtube.png" class="img-responsive" />
        </div></a>

      </div>
      <h2 class="personal-header"><span>Bounty</span><i class="info-mark"></i></h2>
      <div class="personal-text"><span>Share this link and get 10% of payments of your referrals</span></div>
      <form>
        <div class="input  bounty">
          <input type="text" autocomplete="on" name="ref-link" id="ref_link" placeholder=""  value="<?php echo get_data_by_id('bonus_link','userId',$this->session->userdata('user_id'),'link');?>" readonly=""><span></span>
          <div class="box">Copied!</div><div class="errors"></div><div class="errors"></div></div>
        </form>
      </div>
    </div>
  </div>

</div>
</div>

<!-- Trigger the modal with a button -->


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
        <div class="payment">
          <h2 class="personal-header"><span>Buy using Ethereum</span></h2><label class="input-label" for="amount"><span>Amount ETH</span></label>
          <div class="row">
            <div class="col-amount">
              <div class="input  "><input type="text"  id="value1" autocomplete="on" name="amount" placeholder="Amount" value="1"><span></span>
                <div class="errors"></div>
              </div>
            </div>
            <div class="col-total">
              <div class="fields">
                <div class="price">
                  <div class="bunny-price"><?php echo number_format(get_data_by_id('total_supply','title','1ETH','supply'),'2','.','');?></div><span class="symbol"> KICK</span>
                </div>
                <div class="equals">+</div>
                <div class="price"> <div class="bonus-amount active">10% </div><span class="symbol">BONUS</span></div>
                <div class="equals">=</div>
                <div class="price"> <div class="total-sum"><?php $data  = get_data_by_id('total_supply','title','1ETH','supply'); $dat1=$data*(0.10);echo number_format($data+$dat1,'2','.','');?></div><span class="symbol"> KICK</span></div>
              </div>
            </div>
            <div class="input-text"><span>1000 KICK minimum purchase</span></div>
          </div>
          <div class="row progress-bar-row">
            <div class="col-full">
              <div class="progress-bar">
                <div class="content">
                  <div class="bar">
                    <div class="progress-wrap">
                      <div class="scale top">
                        <div class="item " style="left: 0%;">
                          <span class="title"><span>BONUS</span>
                        </span>
                      </div>
                      <div class="item " style="left: 10%;">
                        <span class="title">
                          <span>10%</span>
                        </span></div>
                        <div class="item " style="left: 20%;">
                          <span class="title"><span>20%</span></span></div>
                          <div class="item " style="left: 50%;"><span class="title"><span>50%</span></span></div>
                          <div class="item " style="left: 75%;"><span class="title"><span>75%</span></span></div>
                          <div class="item last" style="left: 100%;"><span class="title"><span>100%</span></span>
                          </div></div>
                          <div class="scale mid"><div class="item " style="left: 0%;"><span class="title"></span></div>
                          <div class="item " style="left: 10%;">
                            <span class="title"><span class="mark"></span></span>
                          </div>
                          <div class="item " style="left: 20%;"><span class="title"><span class="mark"></span></span></div>
                          <div class="item " style="left: 50%;"><span class="title"><span class="mark"></span></span></div>
                          <div class="item " style="left: 75%;"><span class="title"><span class="mark"></span></span></div>
                          <div class="item last" style="left: 100%;"><span class="title"></span></div></div>
                          <div class="progress" style="width: 0%;"><span class="percent">0%</span></div>
                          <div class="scale bottom">
                            <div class="item " style="left: 0%;">
                              <span class="title"><span>ETH</span></span></div>
                              <div class="item " style="left: 10%;"><span class="title"><span>Ξ1</span></span></div>
                              <div class="item " style="left: 20%;"><span class="title"><span>Ξ5</span></span></div>
                              <div class="item " style="left: 50%;"><span class="title"><span>Ξ10</span></span></div>
                              <div class="item " style="left: 75%;"><span class="title"><span>Ξ20</span></span></div>
                              <div class="item last" style="left: 100%;"><span class="title"><span>Ξ50</span></span></div>
                            </div></div></div></div></div></div></div>
                            <div class="divider"></div>
                            <div class="row">
                              <div class="col-full"><label class="input-label" for="address"><span>Payment Address</span></label>
                                <div class="input  copy-button">

                                  <input type="text" autocomplete="on" name="address" id="mainaddress" value="<?php echo get_data_by_id('user_address','userId',$this->session->userdata('user_id'),'address');?>" placeholder="" readonly="">
                                  <div class="alert alert-success">
                                    <strong>Copied!</strong> 
                                  </div>
                                  <span class="copy"><span>Copy</span></span><span></span>
                                  <div class="errors"></div>
                                </div>
                                <div class="exchanges-text"><span>You can send Ethereum from exchanges</span></div>
                              </div>
                            </div>
                            <div class="payment-additional-ethereum">
                              <div class="row">
                                <div class="col-half"><label class="input-label" for="address"><span>Gas limit</span></label>
                                  <div class="value-item">21,000<span class="symbol"> </span></div>
                                </div>
                                <div class="col-half"><label class="input-label" for="address"><span>Gas price</span></label>
                                  <div class="value-item">12<span class="symbol"> Gwei</span></div>
                                </div>
                              </div>
                              <div class="double-buttons">
                                <div class="button-wrapper">

                                 <?php $var ='<input type="hidden" name="hidden" id="hidden" value="">';?> 
                                 <div class="content">
                                  <a id="myether" href="https://www.myetherwallet.com/?to=<?php echo get_data_by_id('user_address','userId',$this->session->userdata('user_id'),'address');?>&amp;value=1&amp;gas=21000&amp;gasprice=12x#send-transaction;" target="_blank" class="button blue undefined   "><span></span><span>MyEtherWallet</span></a></div>
                                </div>/*
                                <div class="button-wrapper">
                                  <div class="content"><button class="button blue undefined transferFunds" type="button"><span></span><span>MetaMask</span></button></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="myModalbitcoin" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                         <div class="payment">
                          <h2 class="personal-header"><span>Buy using Bitcoin</span></h2><label class="input-label" for="amount"><span>Amount BTC</span></label>
                          <div class="row">
                            <div class="col-amount">
                              <div class="input  "><input type="text"  id="value2" autocomplete="on" name="amount" placeholder="Amount" value="1"><span></span>
                                <div class="errors"></div>
                              </div>
                            </div>
                            <div class="col-total">
                              <div class="fields">
                                <div class="price">
                                  <div class="bunny-price1">80,000</div><span class="symbol"> KICK</span>
                                </div>
                                <div class="equals">+</div>
                                <div class="price"> <div class="bonus-amount1 active">75% </div><span class="symbol">BONUS</span></div>
                                <div class="equals">=</div>
                                <div class="price"> <div class="total-sum1">1,40,000</div><span class="symbol"> KICK</span></div>
                              </div>
                            </div>
                            <div class="input-text"><span>1000 KICK minimum purchase</span></div>
                          </div>
                          <div class="row progress-bar-row">
                            <div class="col-full">
                              <div class="progress-bar1">
                                <div class="content">
                                  <div class="bar"> 
                                    <div class="progress-wrap">
                                      <div class="scale top">
                                        <div class="item " style="left: 0%;">
                                          <span class="title"><span>BONUS</span>
                                        </span>
                                      </div>
                                      <div class="item " style="left: 10%;">
                                        <span class="title">
                                          <span>10%</span>
                                        </span></div>
                                        <div class="item " style="left: 20%;">
                                          <span class="title"><span>20%</span></span></div>
                                          <div class="item " style="left: 50%;"><span class="title"><span>50%</span></span></div>
                                          <div class="item " style="left: 75%;"><span class="title"><span>75%</span></span></div>
                                          <div class="item last" style="left: 100%;"><span class="title"><span>100%</span></span>
                                          </div></div>
                                          <div class="scale mid"><div class="item " style="left: 0%;"><span class="title"></span></div>
                                          <div class="item " style="left: 10%;">
                                            <span class="title"><span class="mark"></span></span>
                                          </div>
                                          <div class="item " style="left: 20%;"><span class="title"><span class="mark"></span></span></div>
                                          <div class="item " style="left: 50%;"><span class="title"><span class="mark"></span></span></div>
                                          <div class="item " style="left: 75%;"><span class="title"><span class="mark"></span></span></div>
                                          <div class="item last" style="left: 100%;"><span class="title"></span></div></div>
                                          <div class="progress1" style="width: 0%;">
                                            <span class="percent1">0%</span></div>
                                          <div class="scale bottom">
                                            <div class="item " style="left: 0%;">
                                              <span class="title"><span>BTC</span></span></div>
                                              <div class="item " style="left: 10%;"><span class="title"><span>Ƀ0.05</span></span></div>
                                              <div class="item " style="left: 20%;"><span class="title"><span>Ƀ0.3</span></span></div>
                                              <div class="item " style="left: 50%;"><span class="title"><span>Ƀ0.6</span></span></div>
                                              <div class="item " style="left: 75%;"><span class="title"><span>Ƀ1</span></span></div>
                                              <div class="item last" style="left: 100%;"><span class="title"><span>Ƀ3</span></span></div>
                                            </div></div></div></div></div></div></div>
                                            <div class="divider"></div>
                                            <div class="row">
                                              <div class="col-full"><label class="input-label" for="address"><span>Payment Address</span></label>
                                                <div class="input  copy-button">

                                                  <input type="text" autocomplete="on" name="address" id="btcaddress" value="<?php echo get_data_by_id('btc_address','userId',$this->session->userdata('user_id'),'address');?>" placeholder="" readonly="">
                                                  <div class="alert alert-success">
                                                    <strong>Copied!</strong> 
                                                  </div>
                                                  <span class="copy"><span>Copy</span></span><span></span>
                                                  <div class="errors"></div>
                                                </div>
                                                <div class="exchanges-text"><span>You can send Ethereum from exchanges</span></div>
                                              </div>
                                            </div>
                                            <div class="payment-additional-ethereum">

                                              <div class="double-buttons">
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                      </div>

                                    </div>
                                  </div>

								  
								  
                                  <div class="modal fade" id="myModal11" role="dialog">
                                    <div class="modal-dialog">

                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        </div>
                                        <div class="modal-body">

                                          <div class="contract-address"><h2 class="personal-header"><span>KickSport Smart Contract Address</span></h2>
                                            <div class="input  "><input type="text" id="kickcont" autocomplete="on" value="0x6B62f8458FbecC2eD07021C823A1eBB537641ffb" readonly="">
                                              <div class="box">Copied!</div><div class="errors"></div>
                                            </div>
                                            <span class="copy_text">Copy this address to your wallet to view your KICK tokens.<br>
                                              Do not send funds from an exchange to this address.</span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>


                                    <script type="text/javascript">
                                    window.addEventListener('load', function() {
                                      console.log('starting...');
                                      if(typeof web3 !== 'undefined') {
                                        web3 = new Web3(web3.currentProvider);

                                        $("button.transferFunds").click(function(){
                                          alert('Connect to metamask');
                                        });
      //alert('You need <a href="https://metamask.io/">MetaMask</a> browser plugin to run this example');
      // Or connect to a node
    } else {
      web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));
      // web3 =   web3.setProvider(new web3.providers.HttpProvider('https://api.myetherapi.com/rop'));


    }

      // Check the connection
      if(!web3.isConnected()) {
        $("button.transferFunds").click(function(){
          alert('You need <a href="https://metamask.io/">MetaMask</a> browser plugin to run this example');
        });
        console.error("Not connected");


      }
      // web3.personal.newAccount("yo",function(err,neww){
      //   console.log(err,neww);
      // });
web3.eth.getAccounts(function(error, accounts) {
  if (!error) {

    web3.eth.getBalance(accounts[0], function(error, balance) {
      if (!error) {

      // console.log('account: ' + accounts[0]);
      // console.log('balance: ' + balance);

      var priceFeedAbi = [
  {
    "constant": true,
    "inputs": [],
    "name": "totalSupply",
    "outputs": [
      {
        "name": "",
        "type": "uint256"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": true,
    "inputs": [
      {
        "name": "_owner",
        "type": "address"
      }
    ],
    "name": "balanceOf",
    "outputs": [
      {
        "name": "balance",
        "type": "uint256"
      }
    ],
    "payable": false,
    "stateMutability": "view",
    "type": "function"
  },
  {
    "constant": false,
    "inputs": [
      {
        "name": "_to",
        "type": "address"
      },
      {
        "name": "_value",
        "type": "uint256"
      }
    ],
    "name": "transfer",
    "outputs": [
      {
        "name": "",
        "type": "bool"
      }
    ],
    "payable": false,
    "stateMutability": "nonpayable",
    "type": "function"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "name": "from",
        "type": "address"
      },
      {
        "indexed": true,
        "name": "to",
        "type": "address"
      },
      {
        "indexed": false,
        "name": "value",
        "type": "uint256"
      }
    ],
    "name": "Transfer",
    "type": "event"
  }
];
      var tokenContract = web3.eth.contract(priceFeedAbi).at("0x6B62f8458FbecC2eD07021C823A1eBB537641ffb");
      listenForClicks(tokenContract,web3);

    }
  });
}
});
});
function listenForClicks(tokenContract,web3){
  web3.eth.getAccounts(function(err, accounts) { console.log(accounts); address = accounts.toString(); })
  var button = document.querySelector('button.transferFunds');
  var button1 = document.querySelector('button.withdraw');
  button.addEventListener('click', function() {
    var amount1 =document.getElementById('value1').value;
    var addressto1 =document.getElementById('mainaddress').value;
    web3.eth.sendTransaction({from:address , to: addressto1,value: web3.toWei(amount1,'ether')},function(err, hash){
      if (err) console.error(err)
        if (hash) {
          callWhenMined(hash,amount1,addressto1);
          console.dir(hash);
        }
      });
  });
}
function callWhenMined(txHash,amount1,addressto1) {
  web3.eth.getTransactionReceipt(txHash, function(error, rcpt) {
    if(error) {
      console.error(error);
    } else {
      if(rcpt == null) {
        setTimeout(function() {
          callWhenMined(txHash,amount1,addressto1,buuny);

        }, 500);
      } else {
        console.log(rcpt);
        if(rcpt['status']=='0x1'){

          var buuny =  amount1*<?php echo get_data_by_id('total_supply','title','1ETH','supply');?>;
          if(amount1>=1 && amount1<5){
      //add 10% bonus
      var buuny = buuny + (buuny*0.10);
    }else if(amount1>=5 && amount1<10){
      var buuny = buuny + (buuny*0.20);
    }else if(amount1>=10 && amount1<20){
      var buuny = buuny + (buuny*0.50);
    }else if(amount1>=20 && amount1<50){
      var buuny = buuny + (buuny*0.75);
    }else if(amount1>=50){
      var buuny = buuny + (buuny*1);
    }else{
      var buuny = amount1*<?php echo get_data_by_id('total_supply','title','1ETH','supply');?>;
    }
    $(".bunny h1").html( buuny + 'KICK');
      //alert("success");
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>index.php/User/buy_token",
        data: {amount:amount1,txhash:txHash,address:addressto1,token:buuny.toFixed(),status:'1'},
        dataType : "json",
        success: function(html){
          location.reload();
        }
      });

    }else{

    }
  }
}
})
}
</script>
<style>
#value1{
  width:165px!important;
}
</style>
<script>
$('.alert-success').hide();
$('.contract-address .box').hide();
$('.bounty .box').hide();
$("input[name='amount']").change(function(){
  var vall = this.value;
  var ethe=$("#mainaddress").val();
  var href_ = "https://www.myetherwallet.com/?to="+ethe+"&ampvalue="+vall+"&amp;gas=21000&amp;gasprice=12x#send-transaction";
  $("#myether").attr('href',href_);
      //$("#hidden").val(vall);
    });
var states = function() { 

  $.getJSON("https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=BTC,USD,EUR", function( data ) {
    var eth = ($(".bunny h1").attr('data-attr')*<?php echo get_data_by_id('total_supply','title','1Bunny','supply');?>);

    $.each( data, function( key, val ) {
      if(key == 'BTC'){
      var test = $(".bunny h1").attr('data-attr');

      $("span#btc").text('~ ' + test * val + ' BTC');

      }else if(key == 'USD'){
        $("#usd").text('~ '+ eth *val + ' USD');
      }else{

      }
    });
  });
  setTimeout(states, 10000);

}
setTimeout(states, 10000);

var myajax = function() { 
  var ethaddress =$("#mainaddress").val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>index.php/User/update_record",
        data: {ethaddress:ethaddress},
        dataType : "json",
        success: function(html){

          if((html!='')){
     location.reload();

   }
    }
  });

      //if you need to run again every 10 seconds
      setTimeout(myajax, 10000);
    };

    setTimeout(myajax, 10000);

    var bitcoin = function() { 
      $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>index.php/User/bitcoin_hash",
        success: function(html1){

          if(html1 == 'true'){ location.reload();

   }
    }
  });

      //if you need to run again every 10 seconds
      setTimeout(bitcoin, 10000);

    };

    setTimeout(bitcoin, 10000);

    document.getElementById("mainaddress").onclick = function() {
      this.select();
      document.execCommand('copy');
      $('.alert-success').show();
      setTimeout(function() {
        $('.alert-success').slideUp(1000);
      }, 1000);
    }
    document.getElementById("btcaddress").onclick = function() {
      this.select();
      document.execCommand('copy');
      $('.alert-success').show();
      setTimeout(function() {
        $('.alert-success').slideUp(1000);
      }, 1000);
    }
    document.getElementById("kickcont").onclick = function() {
      this.select();
      document.execCommand('copy');

      $('.contract-address .box').show();
      setTimeout(function() {
        $('.contract-address .box').slideUp(500);
      }, 1000);
    }
    document.getElementById("ref_link").onclick = function() {
      this.select();
      document.execCommand('copy');

      $('.bounty .box').show();
      setTimeout(function() {
        $('.bounty .box').slideUp(500);
      }, 1000);
    }
      // $(".bunny-price").text('0 ');
      //  $(".total-sum").text('0 ');
      $("#value1").keyup(function(){
      //alert(<?php echo get_data_by_id('total_supply','title','1ETH','supply');?>);
      var amount1 =document.getElementById('value1').value;
      var buuny =  amount1*<?php echo get_data_by_id('total_supply','title','1ETH','supply');?>;
      if(amount1>=1 && amount1<5){
      //add 10% bonus
      var total = buuny + (buuny*0.10);
      //alert(total);
      $(".bonus-amount").text('10% ');
      $(".bunny-price").text(buuny.toFixed());

      $(".total-sum").text(total.toFixed());
      $('.progress-bar .progress').css('width', '10%');
      $('.progress-bar .progress .percent').text('10%');
    }
    else if(amount1>=5 && amount1<10){
      var total = buuny + (buuny*0.20);
      $(".bonus-amount").text('20% ');
      $(".bunny-price").text(buuny.toFixed());

      $(".total-sum").text(total.toFixed());
      $('.progress-bar .progress').css('width', '20%');
      $('.progress-bar .progress .percent').text('20%');
    }else if(amount1>=10 && amount1<20){
      var total = buuny + (buuny*0.50);
      $(".bonus-amount").text('50% ');
      $(".bunny-price ").text(buuny.toFixed());

      $(".total-sum").text(total.toFixed());
      $('.progress-bar .progress').css('width', '50%');
      $('.progress-bar .progress .percent').text('50%');
    }else if(amount1>=20 && amount1<50){
      var total = buuny + (buuny*0.75);
      $(".bonus-amount").text('75% ');
      $(".bunny-price").text(buuny.toFixed());

      $(".total-sum").text(total.toFixed());
      $('.progress-bar .progress').css('width', '75%');
      $('.progress-bar .progress .percent').text('75%');
    }else if(amount1>=50){
      var total = buuny + (buuny*1);
      $(".bonus-amount").text('100% ');
      $(".bunny-price").text(buuny.toFixed());
      $(".total-sum").text(total.toFixed());
      $('.progress-bar .progress').css('width', '100%');
      $('.progress-bar .progress .percent').text('100%');
    }else{
      $(".bunny-price").text(buuny.toFixed());
      $(".bonus-amount").text('0% ');
      $(".total-sum").text(buuny.toFixed());
      $('.progress-bar .progress').css('width', '0%');
      $('.progress-bar .progress .percent').text('0%');
    }
      //console.log(buuny.toFixed());
      //  $(".bunny-price").text(buuny.toFixed());

      // $(".total-sum").text('0');

    });
    $("#value2").keyup(function(){
      //alert(<?php echo get_data_by_id('total_supply','title','1ETH','supply');?>);
      var amount1 =document.getElementById('value2').value;
      var buuny =  amount1*<?php echo get_data_by_id('total_supply','title','1BTC','supply');?>;
      if(amount1>=0.05 && amount1<0.3){
      //add 10% bonus
      var total = buuny + (buuny*0.10);
      //alert(total);
      $(".bonus-amount1").text('10% ');
      $(".bunny-price1").text(buuny.toFixed());

      $(".total-sum1").text(total.toFixed());
      $('.progress-bar1 .progress1').css('width', '10%');
      $('.progress-bar1 .progress1 .percent1').text('10%');
    }
    else if(amount1>=0.3 && amount1<0.6){
      var total = buuny + (buuny*0.20);
      $(".bonus-amount1").text('20% ');
      $(".bunny-price1").text(buuny.toFixed());

      $(".total-sum1").text(total.toFixed());
      $('.progress-bar1 .progress1').css('width', '20%');
      $('.progress-bar1 .progress1 .percent1').text('20%');
    }else if(amount1>=0.6 && amount1<1){
      var total = buuny + (buuny*0.50);
      $(".bonus-amount1").text('50% ');
      $(".bunny-price1 ").text(buuny.toFixed());

      $(".total-sum1").text(total.toFixed());
      $('.progress-bar1 .progress1').css('width', '50%');
      $('.progress-bar1 .progress1 .percent1').text('50%');
    }else if(amount1>=1 && amount1<3){
      var total = buuny + (buuny*0.75);
      $(".bonus-amount1").text('75% ');
      $(".bunny-price1").text(buuny.toFixed());

      $(".total-sum1").text(total.toFixed());
      $('.progress-bar1 .progress1').css('width', '75%');
      $('.progress-bar1 .progress1 .percent1').text('75%');
    }else if(amount1>=3){
      var total = buuny + (buuny*1);
      $(".bonus-amount1").text('100% ');
      $(".bunny-price1").text(buuny.toFixed());
      $(".total-sum1").text(total.toFixed());
      $('.progress-bar1 .progress1').css('width', '100%');
      $('.progress-bar1 .progress1 .percent1').text('100%');
    }else{
      $(".bunny-price1").text(buuny.toFixed());
      $(".bonus-amount1").text('0% ');
      $(".total-sum1").text(buuny.toFixed());
      $('.progress-bar1 .progress1').css('width', '0%');
      $('.progress-bar1 .progress1 .percent1').text('0%');
    }
      //console.log(buuny.toFixed());
      //  $(".bunny-price").text(buuny.toFixed());

      // $(".total-sum").text('0');

    });
</script>


<script>

var raised = function() { 

  $.ajax({
    type: "POST",
    url: "<?php echo base_url();?>index.php/User/raised",
    dataType : "json",
    success: function(html){
      if((html!='')){

       $(".raised").text( html.toFixed() + 'ETH');
     }
   }
 });
  setTimeout(raised, 10000);

};

setTimeout(raised, 10000);
</script>
</body>



