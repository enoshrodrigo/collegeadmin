<x-app-layout>
  <div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Welcome to Mazenod College Dashboard</h4>
      </div>
    </div>
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
      <!-- Total News Card -->
      <div class="bg-white shadow-lg rounded-lg p-4 flex items-center">
        <div class="mr-3">
          <!-- Newspaper Icon -->
          <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7v4M5 7v4m2 0v6a2 2 0 002 2h6a2 2 0 002-2v-6m2-4H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z">
            </path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Total News</h3>
          <p class="text-2xl font-bold">{{ $totalNews }}</p>
        </div>
      </div>
      
      <!-- Total Events Card -->
      <div class="bg-white shadow-lg rounded-lg p-4 flex items-center">
        <div class="mr-3">
          <!-- Calendar Icon -->
          <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
            </path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Total Events</h3>
          <p class="text-2xl font-bold">{{ $totalEvents }}</p>
        </div>
      </div>
      
      <!-- Total Admissions Card -->
      <div class="bg-white shadow-lg rounded-lg p-4 flex items-center">
        <div class="mr-3">
          <!-- User Icon -->
          <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M12 12a5 5 0 100-10 5 5 0 000 10z">
            </path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Total Admissions</h3>
          <p class="text-2xl font-bold">{{ $totalAdmissions }}</p>
        </div>
      </div>
      
      <!-- Total Intakes Card -->
      <div class="bg-white shadow-lg rounded-lg p-4 flex items-center">
        <div class="mr-3">
          <!-- Academic Cap Icon -->
          <svg class="w-10 h-10 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 14l9-5-9-5-9 5 9 5z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z">
            </path>
          </svg>
        </div>
        <div>
          <h3 class="text-lg font-semibold">Total Intakes</h3>
          <p class="text-2xl font-bold">{{ $totalIntakes }}</p>
        </div>
      </div>
    </div>
    <!--end Summary Cards -->
    <div class="row">


    <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-2">News</h6>
                 
                </div>
                <div class="d-flex flex-column">
                   @foreach ($latestNews as $news)
                  <a class="d-flex align-items-center border-bottom pb-3">
                    <div class="me-3">
                      @if ($news->status == 1)
                      <span class="badge rounded-circle wd-50  align-content-center text-bold  badge-true bg-green-600" style="height:50px">{{ 'Active'}}</label>
                    @else
                      <span class="badge rounded-circle wd-50  align-content-center text-bold badge-danger bg-red-600" style="height:50px">{{ 'Inactive' }}</label>
                    @endif
                      
                    </div>
                   
                    <div class="w-100">
                      <div class="d-flex justify-content-between">
                        <h6 class="text-body mb-2 ">{{ $news -> title }}</h6>
                        <p class="text-muted
                        tx-12">{{ $news -> date }}</p>
                      </div>
                          {{-- if action is link give me p tag other wise its route as _blank to  --}}
                     <p class="text-muted tx-13 hover:text-primary" 
   style="cursor: pointer;" 
   onclick="window.open('{{ $news->action == 'link' ? $news->action_link : route('news.show', $news->id) }}', '_blank');">
   {{$news->button_text }}
</p>

                    </div>
                   
                  </a>
                  @endforeach
                 
                </div>
              </div>
              <div class="mt-4">
                {{ $latestNews->onEachSide(1)->links() }}
              </div>
            </div>
            
          </div>


      <div class="col-lg-7 col-xl-8 stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-2">Events</h6>
            </div>
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    
                    <th class="pt-0">Event Name</th>
                    <th class="pt-0">Date</th> 
                    <th class="pt-0">Link</th> 
                    <th class="pt-0">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($events as $event)
                    <tr>
                     
                      <td>{{ $event->title }}</td>
                      <td>{{ $event->date }}</td>
                       {{-- if link availble then show link button go to new tab and oprn if its empty or null just gray the link  --}}
                      <td>
                        @if ($event->link)
                          <a href="{{ $event->link }}" target="_blank" class="text-blue-600 hover:underline">View More Photos</a>
                        @else
                          <span class="text-gray-600">-</span>
                        @endif
                      </td>
                      <td>
                        @if ($event->status == 1)
                          <label class="badge badge-true bg-green-600  ">{{ 'Active'}}</label>
                        @else
                          <label class="badge badge-danger bg-red-600">{{ 'Inactive' }}</label>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="mt-4">
                {{ $events->onEachSide(1)->links() }}
              </div>
            </div>
          </div> 
        </div>
      </div>

    </div>
    
    <!-- row -->

 <div class="row  mt-4 ">
  <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-2">Admissions</h6>
         
        </div>
        <div class="d-flex flex-column">
           @foreach ($recentAdmissions as $admissions)
          <a class="d-flex align-items-center border-bottom pb-3">
            <div class="me-3"> 
              <span class="badge rounded-circle wd-50  align-content-center text-bold badge-danger bg-red-600" style="height:50px">{{ $loop->iteration}}</label>
         
              
            </div>
           
            <div class="w-100">
              <div class="d-flex justify-content-between">
                <h6 class="text-body mb-2 ">{{ $admissions -> name   }}</h6>
                <p class="text-muted
                tx-12">{{ $admissions -> dob }}</p>
              </div>
              @php
              $intakeName = collect($intakeBatches->items())->firstWhere('id', $admissions->intake_id)->name ?? '-';
            
         @endphp
             <p class="text-muted tx-13 hover:text-primary">
{{ $intakeName }}
</p>

            </div>
           
          </a>
          @endforeach
         
        </div>
      </div>
      <div class="mt-4">
        {{ $latestNews->onEachSide(1)->links() }}
      </div>
    </div>
    
  </div>


  <div class="col-lg-7 col-xl-8 stretch-card">
    <div class="card " style="
    background-color: #ECF4F1;
    border: solid 1px #F0F4E3;
    box-shadow: 0px 1px 5px 1px #ffffff;
">
      <div class="card-body  "> 
        <div class="contact-info  ">
          <div class="contact-info-title text-center mb-4 px-5">
            <h3 class="mb-1">School Calendar</h3>
            <div class="calendar-embed mt-4  ">
              <div class="ratio ratio-16x9  ">
                <iframe src="https://calendar.google.com/calendar/embed?src=mazenodanuradhapura%40gmail.com&ctz=Asia%2FColombo" style="border:0;  " allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>
  
  <!-- row -->


  </div>
  <!-- Page Content Ends -->
</x-app-layout>
