
<!-- section start  -->
<div class="container-fluid token" id="particles-js">
  <div class="container zindex">
    <div class="row">
      <div class="col-md-9 col-xs-12 full_left">
        <div class="row">
          <div class="col-md-8 col-xs-12">
            <div class="left_left">
              <h3><?php echo $this->lang->line("token");?></h3>
              <div class="bunny">
                <h1 data-attr="<?php echo (!empty($calculatebunny))?$calculatebunny[0]->Total:"0";?>"><?php  echo (!empty($calculatebunny))?$calculatebunny[0]->Total:"0";?> KICK</h1>
               <span>~<?php  echo (!empty($calculatebunny))?($calculatebunny[0]->Total * 0.0004):"0";?> ETH</span>
                <span>~0 BTC</span>
                <span id="usd">~0 USD</span> 
              </div>
              <ul class="big_btnn">
                <li><img src="<?php echo site_url() ?>images/b1.svg" class="img-responsive icon_btn" /><button class="pop" type="button" data-toggle="modal" data-target="#myModal">Ethereum</button>
                </li>
                <li><img src="<?php echo site_url() ?>images/b2.svg" class="img-responsive icon_btn" /><button class="pop" type="button" data-toggle="modal" data-target="#myModalbitcoin">Bitcoin</button></li>
              </ul>
             <!--  <ul class="small_btnn">
                <li><a href="#"><img src="<?php echo site_url() ?>images/b3.svg" class="img-responsive icon_btn" />Bitcoin cash</a></li>
                <li><a href="#"><img src="<?php echo site_url() ?>images/b4.svg" class="img-responsive icon_btn" />Bitcoin gold</a></li>
                <li><a href="#"><img src="<?php echo site_url() ?>images/b5.svg" class="img-responsive icon_btn" />Litecoin</a></li>
              </ul> -->
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <div class="right_right">
              <span>Current price</span>
              <h1>1 ETH=5,342 KICK</h1>
              <span>Current price</span>
              <img src="<?php echo site_url() ?>images/time.png" class="img-responsive" />
              <span>Raised</span>
              <h1>8,932.06 ETH</h1>
              <br>
              <!--            <span>BUNNY Smart Contract Address</span> -->
              <div class="contract-info"><span>KICK Smart Contract Address</span><i class="fa fa-info" data-toggle="modal" data-target="#myModal1"></i></div>
            </div>
          </div>
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
            <div class="input  ">
            <input type="text" autocomplete="on" name="ref-link" placeholder="" readonly=""><span></span><div class="errors"></div></div>
          </form>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-9 col-xs-12 full_left">
          <div class="left_eight">
            <h1>History</h1>

            <?php if(!empty($result)){?>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Etherum</th>
                  <th>Date</th>
                  <th>value</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as $result1) {?>
                <tr>
                  <td><a href="http://ropsten.etherscan.io/tx/<?php echo $result1->transaction_hash;?>" target="_blank"><?php echo $result1->transaction_hash;?></a></td>
                  <td><?php echo $result1->date;?></td>
                  <td>+<?php echo $result1->bunny;?>  KICK</td>
                  <td><?php echo ($result1->status==1)?'succcess':'fail';?></td>

                </tr>
                
                <?php }}else{?>
                <span>Here you transaction history will be shown</span>

                <?php } ?>

                

              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-3 col-xs-12 pad">
          <div class="right_four1">
            <ul>
              <li><a href="#"><img src="<?php echo site_url() ?>images/rb1.svg" class="img-responsive icon_btnrb" />Withdrawal</a></li>
              <li><a href="<?php echo base_url();?>assets/whitepaper_0.2.pdf" target="_blank"><img src="<?php echo site_url() ?>images/rb2.svg" class="img-responsive icon_btnrb" />Whitepaper</a></li>
              <li><a href="#"><img src="<?php echo site_url() ?>images/rb3.svg" class="img-responsive icon_btnrb" />MVP Version</a></li>
              <li><a href="#"><img src="<?php echo site_url() ?>images/rb4.svg" class="img-responsive icon_btnrb" />Tutorial</a></li>
            </ul>
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
                  <div class="bunny-price">5,342</div><span class="symbol"> KICK</span>
                </div>
                <div class="equals">+</div>
                <div class="price"> <div class="bonus-amount active">10% </div><span class="symbol">BONUS</span></div>
                <div class="equals">=</div>
                <div class="price"> <div class="total-sum">5877 </div><span class="symbol"> KICK</span></div>
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
           <!--  <div class="button-wrapper">
                <div class="content"><a href="https://www.myetherwallet.com/?to=0xc81a355bddb646c003637372634f36a94b5e5b2c&amp;value=1&amp;gas=21000&amp;gasprice=12x#send-transaction" target="_blank" class="button blue undefined   "><span></span><span>MyEtherWallet</span></a></div>
              </div> -->
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
                  <div class="bunny-price">60.399</div><span class="symbol"> KICK</span>
                </div>
                <div class="equals">+</div>
                <div class="price"> <div class="bonus-amount active">75% </div><span class="symbol">BONUS</span></div>
                <div class="equals">=</div>
                <div class="price"> <div class="total-sum">105.698</div><span class="symbol"> KICK</span></div>
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

<div class="modal fade" id="myModal1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

      </div>
      <div class="modal-body">
           
              <div class="contract-address"><h2 class="personal-header"><span>KickSport Smart Contract Address</span></h2>
                <div class="input  "><input type="text" id="kickcont" autocomplete="on" value="0xc1c0082a6e0acb122f2783bd749ea7beb3a34228" readonly="">
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
               alert('Login to metamask');
              });
            //alert('You need <a href="https://metamask.io/">MetaMask</a> browser plugin to run this example');
            // Or connect to a node
          } else {
            web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));


          }

            // Check the connection
            if(!web3.isConnected()) {
              console.error("Not connected");
              $("button.transferFunds").click(function(){
               alert('You need <a href="https://metamask.io/">MetaMask</a> browser plugin to run this example');
              });

            }
            // web3.personal.newAccount("yo",function(err,neww){
            //   console.log(err,neww);
            // });
web3.eth.getAccounts(function(error, accounts) {
  if (!error) {

    web3.eth.getBalance(accounts[0], function(error, balance) {
      if (!error) {

       console.log('account: ' + accounts[0]);
       console.log('balance: ' + balance);

       var priceFeedAbi = [
       {
        "anonymous": false,
        "inputs": [
        {
          "indexed": true,
          "name": "_owner",
          "type": "address"
        },
        {
          "indexed": true,
          "name": "_spender",
          "type": "address"
        },
        {
          "indexed": false,
          "name": "_value",
          "type": "uint256"
        }
        ],
        "name": "Approval",
        "type": "event"
      },
      {
        "constant": false,
        "inputs": [
        {
          "name": "_spender",
          "type": "address"
        },
        {
          "name": "_value",
          "type": "uint256"
        }
        ],
        "name": "approve",
        "outputs": [
        {
          "name": "success",
          "type": "bool"
        }
        ],
        "payable": false,
        "stateMutability": "nonpayable",
        "type": "function"
      },
      {
        "constant": false,
        "inputs": [
        {
          "name": "_spender",
          "type": "address"
        },
        {
          "name": "_value",
          "type": "uint256"
        },
        {
          "name": "_extraData",
          "type": "bytes"
        }
        ],
        "name": "approveAndCall",
        "outputs": [
        {
          "name": "success",
          "type": "bool"
        }
        ],
        "payable": false,
        "stateMutability": "nonpayable",
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
          "name": "success",
          "type": "bool"
        }
        ],
        "payable": false,
        "stateMutability": "nonpayable",
        "type": "function"
      },
      {
        "constant": false,
        "inputs": [
        {
          "name": "_from",
          "type": "address"
        },
        {
          "name": "_to",
          "type": "address"
        },
        {
          "name": "_value",
          "type": "uint256"
        }
        ],
        "name": "transferFrom",
        "outputs": [
        {
          "name": "success",
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
          "name": "_from",
          "type": "address"
        },
        {
          "indexed": true,
          "name": "_to",
          "type": "address"
        },
        {
          "indexed": false,
          "name": "_value",
          "type": "uint256"
        }
        ],
        "name": "Transfer",
        "type": "event"
      },
      {
        "inputs": [],
        "payable": false,
        "stateMutability": "nonpayable",
        "type": "constructor"
      },
      {
        "payable": false,
        "stateMutability": "nonpayable",
        "type": "fallback"
      },
      {
        "constant": true,
        "inputs": [
        {
          "name": "_owner",
          "type": "address"
        },
        {
          "name": "_spender",
          "type": "address"
        }
        ],
        "name": "allowance",
        "outputs": [
        {
          "name": "remaining",
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
        "constant": true,
        "inputs": [],
        "name": "decimals",
        "outputs": [
        {
          "name": "",
          "type": "uint8"
        }
        ],
        "payable": false,
        "stateMutability": "view",
        "type": "function"
      },
      {
        "constant": true,
        "inputs": [],
        "name": "name",
        "outputs": [
        {
          "name": "",
          "type": "string"
        }
        ],
        "payable": false,
        "stateMutability": "view",
        "type": "function"
      },
      {
        "constant": true,
        "inputs": [],
        "name": "symbol",
        "outputs": [
        {
          "name": "",
          "type": "string"
        }
        ],
        "payable": false,
        "stateMutability": "view",
        "type": "function"
      },
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
        "inputs": [],
        "name": "version",
        "outputs": [
        {
          "name": "",
          "type": "string"
        }
        ],
        "payable": false,
        "stateMutability": "view",
        "type": "function"
      }
      ];
      var tokenContract = web3.eth.contract(priceFeedAbi).at("0xc1c0082a6e0acb122f2783bd749ea7beb3a34228");
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
//  button1.addEventListener('click', function() {
//  // var amount =document.getElementById('value').value;
//  // var addressto =document.getElementById('addressto').value;
//   //transaction = {"from": "0xf9e5041a578d48331c54ba3c494e7bcbc70a30ca"}
//  //txid = contract.transact(transaction).transfer(buddy_address, amount)
//   tokenContract.transfer('0x4721eA599679FC85c15EB7b7841848e4A87751b2',450, function (err, hash) {
//   if (err) console.error(err)

//   if (hash) {
//     console.log('Transaction sent');
//     console.dir(hash);
// //callWhenMined(hash); 
//   }
// //});
// });
//  });

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

          var buuny =  amount1*5343;
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
  var buuny = amount1*5343;
}
$(".bunny h1").html( buuny + 'KICK');
alert("success");
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
 setTimeout(function() {
$.getJSON("https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=BTC,USD,EUR", function( data ) {
  var eth = ($(".bunny h1").attr('data-attr')*0.0004);
   
 $.each( data, function( key, val ) {
  if(key == 'BTC'){
   

  }else if(key == 'USD'){
      $("#usd").text('~ '+ eth *val + ' USD');
  }else{

  }
  });
});
 }, 1000);
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
 // $(".bunny-price").text('0 ');
 //  $(".total-sum").text('0 ');
 $("#value1").keyup(function(){

  var amount1 =document.getElementById('value1').value;
  var buuny =  amount1*5343;
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

</script>


