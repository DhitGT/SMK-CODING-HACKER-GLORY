<div class="pt-7">
    <form action="" id="filterForm" method="post">
        <div class="flex gap-4 justify-center">
            <input type="text" name="search"
                class="rounded p-1 my-auto h-[50%] border-2 border-black w-[20%] focus:w-[40%] duration-300"
                placeholder="Search ">
            <button type="submit" class="hover:scale-90 duration-100"><img class="w-5 md:w-8"
                    src="../../MadingSchool/resource/icon/search-2-line.svg" alt="search icon"></button>

            <div class="flex rounded bg-gray-300 px-1 md:px-2">
                <img src="../../MadingSchool/resource/icon/filter-line.svg" alt="filter icon" class="w-5 md:w-8">
                <select name="filter" id="filter" class="bg-gray-300 px-1 w-fit md:px-3 hover:cursor-pointer">
                    <option name="filter" value="all" class="bg-gray-200 p-2 rounded" <?php echo (isset($_SESSION['filter'])
                        && $_SESSION['filter']=='all' )?  'selected' : '' ?>>All</option>
                    <option name="filter" value="siswa" class="bg-gray-200 p-2 rounded" <?php echo (isset($_SESSION['filter'])
                        && $_SESSION['filter']=='siswa' )?  'selected' : '' ?>>Siswa</option>
                    <option name="filter" value="osis" class="bg-gray-200 p-2 rounded" <?php echo (isset($_SESSION['filter'])
                        && $_SESSION['filter']=='osis' )?  'selected' : '' ?>>Osis</option>
                    <option name="filter" value="ketua eskul" class="bg-gray-200 p-2 rounded" <?php
                        echo (isset($_SESSION['filter']) && $_SESSION['filter']=='ketua eskul' )?  'selected' : '' ?>>Ketua
                        Eskul</option>
                    <option name="filter" value="guru" class="bg-gray-200 p-2 rounded" <?php echo (isset($_SESSION['filter'])
                        && $_SESSION['filter']=='guru' )?  'selected' : '' ?>>Guru</option>
                    <option name="filter" value="admin" class="bg-gray-200 p-2 rounded" <?php echo (isset($_SESSION['filter'])
                        && $_SESSION['filter']=='admin' )?  'selected' : '' ?>>Admin</option>

                </select>
            </div>

        </div>
    </form>
</div>

<script>

        function handleFilterOnChange(){
            const filterElem = document.getElementById("filter")

            filterElem.addEventListener("change", function (){
                let selected = filterElem.value

                const filterForm = document.getElementById("filterForm");
                filterForm.submit()
            })
        }
        
        handleFilterOnChange()

    </script>