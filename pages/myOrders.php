<?php
require_once('classes/db.php');
include 'tempelates/user-navbar/user-navbar.php';
require_once "controllers/generateMyOrders.php"
//include 'tempelates/userHeader.php';
?>
<div id="headOrders">
    <div class="container-fluid" id="myOrders">
        <h2 class="text" id="head">Your past orders 😋 </h2>
            <p class="search_input filter text">
                <label class="text">Start date</label>
                <input class="text"type="date" name="start" id="start">
                <label class="text">End date</label>
                <input class="text"type="date" name="end" id="end">
                <input class ="filterBtn"onclick="filterCheck()" type="submit" value="Filter" name="submit" class="">
            </p>
    <div id="accordionn">
    <?
        $start=date("Y-m-d", strtotime('-3 day'));
        $end = date("Y-m-d");
        echo generateOrders($start,$end,'1')
        ?>
    </div>

    </div>
</div>
<<<<<<< HEAD

=======
    <nav aria-label="Page navigation" id = "Pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a onclick="prevPage(event)" class="page-link" style="color: dodgerblue" id="prev"> < </a></li>
            <li class="page-item"><a class="page-link" style="color: dodgerblue" id="currentPage">1</a></li>
            <li class="page-item"><a onclick="nextPage(event)" class="page-link" style="color: dodgerblue" id="next"> > </a></li>
        </ul>
    </nav>
>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
    <script>
        document.getElementById("end").valueAsDate = new Date();
        let start = new Date();
        start.setDate(start.getDate() - 3)
        document.getElementById("start").valueAsDate = start;
        //AJAX
<<<<<<< HEAD
        function filterCheck(){
=======
        function filterCheck(page){
>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
            const startD = document.getElementById("start").value;
            const endD = document.getElementById("end").value;
            const accordionElement = document.getElementById("accordionn");
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    while (accordionElement.firstChild) {
                        accordionElement.removeChild(accordionElement.firstChild);
                    }
                    accordionElement.innerHTML = this.responseText;
                }
            };
<<<<<<< HEAD
            xmlhttp.open("GET", `/generateMyOrders?start=${startD}&end=${endD}&page=1`, true);
            xmlhttp.send();
        }
=======
            xmlhttp.open("GET", `/generateMyOrders?start=${startD}&end=${endD}&page=${page}`, true);
            xmlhttp.send();
        }

>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
        function cancelOrder(event){
            let id = event.target.id;
            const startD = document.getElementById("start").value;
            const endD = document.getElementById("end").value;
            const accordionElement = document.getElementById("accordionn");
            let xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    while (accordionElement.firstChild) {
                        accordionElement.removeChild(accordionElement.firstChild);
                    }
                    accordionElement.innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", `/cancelOrder?id=${id}`, true);
            xmlhttp.send();
            setTimeout(()=>{
                xmlhttp.open("GET", `/generateMyOrders?start=${startD}&end=${endD}&page=1`, true);
                xmlhttp.send();
            },20)
        }
<<<<<<< HEAD
=======

        function nextPage() {
            let ordNo = document.getElementsByClassName("order").length;
            if(ordNo!==0){
                let currentPage = parseInt(document.getElementById("currentPage").innerText);
                currentPage+=1;
                document.getElementById("currentPage").innerText=`${currentPage}`;
                filterCheck(currentPage)
            }
        }

        function prevPage() {
            let currentPage = parseInt(document.getElementById("currentPage").innerText);
            if(currentPage>1){
                currentPage-=1;
                          document.getElementById("currentPage").innerText=`${currentPage}`;
                filterCheck(currentPage)
            }
        }

>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
        function accordionFix(event) {
            document.querySelectorAll(".data").forEach((element) => {
                    document.querySelectorAll(".data").forEach((element) => {
                            setTimeout(()=>{element.classList.remove("show")},10);
                    });
            })
        }
    </script>
<?php
// include "tempelates/footer.php";
?>