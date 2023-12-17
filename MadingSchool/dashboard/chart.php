<?php 
    include "../function.php";
    // midware {
    checkLogin("../login");
    $user_Roles = mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['role'];
    if(!getRoleIsChecked($user_Roles,"can_view_stats")){
        header('location:../index.php');
    }
    // midware }

    $by = isset( $_POST['filter'])? $_POST['filter']: (isset($_GET['filter'])? $_GET['filter'] : 'views_total');
    $order = 'desc';

    $curent_page = isset($_GET['page'])? $_GET['page'] : 1;
    $posts = getPostOrderBy($order,$by);

    $query = "SELECT NOW() as current_datetime";
    $result = mysqli_query(conn(), $query);
    $row = mysqli_fetch_assoc($result);

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Statistic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- json to excel libs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>

    <!-- chart js cdn -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../src/index.css">
</head>
<body>
    <!-- navbar -->
    <?php include "../components/navbar.php" ?>
    <!-- navbar end -->
    <div class="container mx-auto">
        <section id='post'>
            <div class="pt-7 bg-gray-200 p-5 flex flex-col gap-4 min-h-screen"> 
                <div class=" flex flex-col gap-4 min-h-100 items-center bg-white rounded-xl shadow-xl p-5 md:px-12 justify-center">
                    <h1 align="left" class="font-bold flex flex-col gap-3">
                        Web View Statistic
                    </h1>

                    <div class="flex">
                        <p> Select By :</p>
                        <select id="select-range" name="select-range" id="">
                            <option value="date">date</option>
                            <option value="week">week</option>
                            <option value="year">year</option>
                        </select>
                    </div>
                    <div class="canvas w-[100%] md:w-[60%] border-2 border-gray-600 rounded text-black">
                        <canvas id="viewChart" class=""></canvas>
                    </div>
                    <button class="p-2 bg-emerald-300 rounded" onclick="handleDownloadExcel()">
                        Export to excel
                    </button>
                    <p align="justify">Berdasarkan data di atas, user paling banyak mengunjungi website pada tanggal <span id="most-day"></span> yakni sebanyak <span id="most-data"></span> pengunjung dan user paling sedikit mengunjungi website pada tanggal <span id="less-day"></span> yakni sebanyak <span id="less-data"></span> pengunjung</p>
                </div>
                <div class=" flex flex-col gap-4 items-center bg-white rounded-xl shadow-xl p-5 md:px-12 justify-center">
                    <h1 align="left" class="font-bold flex flex-col gap-3">
                        Top 5 Posts Statistic
                    </h1>
                    <div class="flex gap-1">
                        <div class="flex  rounded bg-gray-300 px-1 md:px-2">
                            <img src="../../MadingSchool/resource/icon/filter-line.svg" alt="filter icon" class="w-5 md:w-8">
                            <form action="" id="filterForm" method="post">
                            <select name="filter" id="filter" class="bg-gray-300 px-1 w-fit md:px-3 hover:cursor-pointer">
                                <option name="filter" value="id_post" class="bg-gray-200 p-2 rounded" <?php if(
                                    $by =='id_post' ) echo 'selected' ?>>Id</option>
                                <option name="filter" value="views_total" class="bg-gray-200 p-2 rounded" <?php if(
                                    $by =='views_total' ) echo 'selected' ?>>Views</option>
                                <option name="filter" value="likes_total" class="bg-gray-200 p-2 rounded" <?php if(
                                    $by =='likes_total' ) echo 'selected' ?>>Likes</option>
                            </select>
                            </form>
                        </div>
                        
                    </div>
                    <div class="w-full md:w-3/4 bg-white rounded-xl shadow-2xl border-2 border-gray-400 h-max overflow-y-hidden">
                        <table class="min-w-fit  bg-white rounded-xl">
                            <thead>
                                <tr>
                                    <th class="py-2 text-left px-4 ">No</th>
                                    <th class="py-2 text-left px-4 ">Id</th>
                                    <th class="py-2 text-left px-4 sticky left-0 bg-white">Judul</th>
                                    <th class="py-2 text-left px-4 ">Like</th>
                                    <th class="py-2 text-left px-4 ">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posts as $index => $data): ?>
                                <tr id="user-row-<?php echo $data['id'] ?>">
                                    <td class="py-2 px-4 "><?php echo $index+1 ?></td>
                                    <td class="py-2 px-4 "><?php echo $data['id_post'] ?></td>
                                    <td class="py-2 px-4 sticky left-0 bg-white"><?php echo $data['judul'] ?> </td>
                                    <td class="py-2 px-4 sticky left-0 bg-white "><?php echo $data['likes_total'] ?> </td>
                                    <td class="py-2 px-4 "><?php echo $data['views_total'] ?></td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </section>
    </div>
    <?php include '../components/footer.php' ?>

    <script>
        let labels = [];
        let data = [];
        let jsonDatas 
        let dataView;
        let highestData;
        let lowestData;
        let lowestDate;
        let highestDate;
        getData('date')
                   
        
        function handleFilterOnChange(){
            const filterElem = document.getElementById("filter")

            filterElem.addEventListener("change", function (){
                let selected = filterElem.value

                const filterForm = document.getElementById("filterForm");
                filterForm.submit()
            })
            const orderByElem = document.getElementById("orderBy")

            orderByElem.addEventListener("change", function (){
                let selected = orderByElem.value

                const orderByForm = document.getElementById("orderByForm");
                orderByForm.submit()
            })
        }
        
        handleFilterOnChange()


        function getData(by){
            highestData = Number.MIN_SAFE_INTEGER;
            lowestData = Number.MAX_SAFE_INTEGER;
            highestDate = new Date('0000-01-01');  // Set to a very early date
            lowestDate = new Date('9999-12-31');  
            data = []
            labels = []
            fetch('get_data_'+by+'.php')
            .then(response => response.json())
            .then(jsonData => {
                jsonDatas = jsonData
                jsonData.forEach(item => {
                    labels.push(labelFormat(by,item.date));
                    data.push(item.data);
                    if (item.data >= highestData) {
                        highestData = item.data;
                        highestDate = item.date;
                    }

                    // Update lowestData if the current item.data is smaller
                    if (item.data <= lowestData) {
                        lowestData = item.data;
                        lowestDate = item.date;
                    }
                });

                const ctx = document.getElementById('viewChart').getContext('2d');
                dataView =  new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Views',
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        // Elements options apply to all of the options unless overridden in a dataset
                        // In this case, we are setting the border of each horizontal bar to be 2px wide
                        elements: {
                            bar: {
                                borderWidth: 2,
                            }
                        }
                    }
                });
                if(highestDate.toString().length < 5){
                    document.getElementById('most-day').innerHTML = highestDate
                    document.getElementById('less-day').innerHTML = lowestDate
                }else if(highestDate.toString().length < 7 && highestDate.toString().length >4){
                    document.getElementById('most-day').innerHTML = formatDateRangeByWeek(highestDate)
                    document.getElementById('less-day').innerHTML = formatDateRangeByWeek(lowestDate)
                }else{
                    document.getElementById('most-day').innerHTML = formatDate(highestDate)
                    document.getElementById('less-day').innerHTML = formatDate(lowestDate)
                }
                document.getElementById('most-data').innerHTML = highestData
                document.getElementById('less-data').innerHTML = lowestData
                
            });
        }
        
        function labelFormat(by,date){
            switch (by){
                case 'week':
                    return formatDateRangeByWeek(date)
                    break;
                case 'year':
                    return date   
                    break;
                case 'date':
                    return formatDate(date)
                    break;
            }
        }

        function formatDateRangeByWeek(yearWeek) {
            const year = yearWeek.substring(0, 4);
            const week = parseInt(yearWeek.substring(4), 10);

            const firstDayOfYear = new Date(year, 0, 1);
            const firstDayOfWeek = new Date(firstDayOfYear.setDate(firstDayOfYear.getDate() + (week - 1) * 7));

            const lastDayOfWeek = new Date(firstDayOfWeek);
            lastDayOfWeek.setDate(firstDayOfWeek.getDate() + 6);

            const formattedFirstDay = new Intl.DateTimeFormat('en', { day: 'numeric' }).format(firstDayOfWeek);
            const formattedLastDay = new Intl.DateTimeFormat('en', { day: 'numeric' }).format(lastDayOfWeek);

            return `${formattedFirstDay} - ${formattedLastDay} ${new Intl.DateTimeFormat('en', { month: 'long', year: 'numeric' }).format(firstDayOfWeek)}`;
        }

        function formatDate(date) {
            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            const formattedDate = new Intl.DateTimeFormat('en', options).format(new Date(date));
            return formattedDate;
        }

        function handleSelectChange(){
            const selectElem = document.getElementById("select-range")
            selectElem.addEventListener('change',function (){
                selectBy = selectElem.value;
                if (dataView) {
                    dataView.destroy(); // Destroy the existing chart
                }
                jsonDatas = getData(selectBy)
            });
        }

        function handleDownloadExcel(){
            
            if(jsonDatas.length != 0){
                jsonToExcel(convertToJSON(labels,data),'View Statistic')
            }
        }
  

        function jsonToExcel(jsonData, fileName) {
            const ws = XLSX.utils.json_to_sheet(jsonData);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            XLSX.writeFile(wb, `${fileName}.xlsx`);
        }

        
        function convertToJSON(labels, data) {
            if (labels.length !== data.length) {
                // Handle the case where labels and data have different lengths
                console.error("Error: Labels and data arrays must have the same length.");
                return null;
            }

            const jsonData = [];

            for (let i = 0; i < labels.length; i++) {
                const item = {
                    "Date Range": labels[i],
                    "Views Total": data[i]
                };
                jsonData.push(item);
            }

            return jsonData;
        }

        handleSelectChange()



    </script>
</body>
</html>