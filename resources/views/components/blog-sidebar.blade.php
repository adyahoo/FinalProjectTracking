<form id="formSidebar" method="post" action="{{route('search')}}">
    @csrf
    <div class="form-group m-0" id="formFilter">
        <label for="formFilter" class="font-weight-bold">Filter by Category</label>
        <select class="form-control" id="filterSelect" name="filterSidebar[]">
            <option selected value="">Filter Type</option>
            <option>Technology</option>
            <option>Mobile</option>
            <option>Website</option>
        </select>
    </div>
    <div class="form-group m-0" id="formYear">
        <label for="formArchive" class="mt-4 font-weight-bold">Blog Archive</label>
        <select class="form-control" id="yearSelect" name="filterSidebar[]">
            <option selected value="">By Year</option>
            <option>2020</option>
            <option>2021</option>
            <option>2022</option>
        </select>
    </div>
    <div class="form-group m-0" id="formMonth">
        <select class="form-control mt-2" id="monthSelect" name="filterSidebar[]">
            <option selected value="">By Month</option>
            <option>June</option>
            <option>August</option>
            <option>November</option>
        </select>
    </div>
    <button class="btn section-blog__btn-sidebar text-white mt-3 w-100" type="submit">Submit</button>
</form>