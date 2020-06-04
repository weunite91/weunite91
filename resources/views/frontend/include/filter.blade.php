<div class="investor-filter-search">
    <ul class="filter-search-grid">
        <li class="filter">
            Filter<span class="expand plus"></span>
        </li>
    </ul>
    <div class="filter-grid closed">
        @php
        

        $currentRoute = Route::current()->getName();
        @endphp
        @if($currentRoute=='raising-finance' || $currentRoute=='raising-finance-search')
       
            @else

            
                @endif

                @php 
                   $country_column='id';
                   $currentRoute = Route::current()->getName();
                   if ($currentRoute=='investor')
                   {
                    $country_column='name';
                   }
                        
               
                   @endphp
                  

                <div class="filter-grid-intra multiple-dd" style="width:20% !important">
                    <p class="filtertitle">Country Name</p>
                    <select multiple class="select_all" name="cities[]">
                       @if(array_key_exists("cities",$fillterdata)){
                            @foreach($citylist as $key => $value)
                                <option value = "{{ $value->{$country_column} }}"  {{ in_array($value->{$country_column},$fillterdata['cities']) ? 'selected="selected"' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        }
                        @else{
                            @foreach($citylist as $key => $value)
                                <option value = "{{ $value->{$country_column} }}"  >{{ $value->name }}</option>
                            @endforeach
                        }
                        @endif
                        
                    </select>     
                </div>

                <div class="filter-grid-intra multiple-dd" style="width:20% !important">
                    <p class="filtertitle">Industry Type</p>
                  
                    <select multiple class="select_all" name="industry[]">
                        @if(array_key_exists("industry",$fillterdata)){
                            @foreach($industrylist as $key => $value)
                                <option value = "{{ $value->id }}"  {{ in_array($value->id,$fillterdata['industry']) ? 'selected="selected"' : '' }}>{{ $value->industry }}</option>
                            @endforeach
                        }
                        @else{
                            @foreach($industrylist as $key => $value)
                                <option value = "{{ $value->id }}">{{ $value->industry }}</option>
                            @endforeach
                        }
                        @endif
                    </select>
                </div>
                <div class="filter-grid-intra multiple-dd" style="width:20% !important">
                    <div class="inline-input"  style="margin:0;min-width:170px !important">
                        <p class="filtertitle">Min Investment</p>
                        <input type="text" name="min_investment" placeholder="Min investment *" value="{{ $fillterdata['min_investment'] }}"/>
                    </div>
                </div>
                <div class="filter-grid-intra multiple-dd" style="width:20% !important">
                    <div class="inline-input" style="margin:0;min-width:170px !important" >
                        <p class="filtertitle">Max Investment</p>
                        <input type="text" name="max_investment" placeholder="Max investment *" value="{{ $fillterdata['max_investment'] }}"/>
                    </div>
                </div>
                <div class="filter-grid-intra multiple-dd" style="width:20% !important">
                    <div class="inline-input"  style="margin:0;min-width:170px !important">
                        <p class="filtertitle">Profile Code</p>
                        <input type="text" name="profile_code" placeholder="Profile Code" value="{{ $fillterdata['profile_code'] }}"/>
                    </div>
                </div>
                <div class="inline-input submit-reset">
                    @php
                    $currentRoute = Route::current()->getName();
                    @endphp
                    @if($currentRoute=='raising-finance' || $currentRoute=='raising-finance-search')
                    <a href="{{ route('raising-finance')}}" class="cl_filter">Clear</a>
                    @elseif($currentRoute=='raising-finance-active' || $currentRoute=='raising-finance-active-search')

                    <a href="{{ route('raising-finance-active')}}" class="cl_filter">Clear</a>
                    @else
                    <a href="{{ route('investor')}}" class="cl_filter">Clear</a>
                    @endif

                    <input type="submit" name="pitchaction" value="Search Now" />
                </div>
            
    </div>
</div>	