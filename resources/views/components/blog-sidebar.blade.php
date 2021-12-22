<form id="formSidebar" method="post" action="{{route('filter')}}">
    @csrf
    <div class="form-group m-0" id="formFilter">
        <label for="formFilter" class="font-weight-bold">Filter by Category</label>
        <select class="form-control" id="filterSelect" name="filterSidebar[category]">
            <option selected value="0" disabled>Filter Type</option>
            @foreach($categories as $category)
            <option>{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group m-0" id="formYear">
        <label for="formArchive" class="mt-4 font-weight-bold">Blog Archive</label>
        <select class="form-control" id="yearSelect" name="filterSidebar[year]">
            <option selected value="0" disabled>By Year</option>
            @foreach($blogYears as $year)
            <option>{{$year->year}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group m-0" id="formMonth">
        <select class="form-control mt-2" id="monthSelect" name="filterSidebar[month]" disabled>
            <option selected value="0" disabled>By Month</option>
            @foreach($blogMonths as $month)
            <option value="{{$month->month}}">{{date("F", mktime(0, 0, 0, $month->month, 1))}}</option>
            @endforeach
        </select>
    </div>
    <button class="btn section-blog__btn-sidebar text-white mt-3 w-100" type="submit">Submit</button>
</form>