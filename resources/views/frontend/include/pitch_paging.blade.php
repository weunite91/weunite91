<input type="submit" name="pitchaction" id="pageaction" value="Paging" style="display:none" />
                    <input type="hidden" name="pagetype" id="pagetype" />
                    <div id="pagination" style="width: 100%;">
                    <nav>
                        <ul class="pagination">
            
                          
                              @if ($is_prev_page_disabled==1)
                              <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                <span class="page-link" aria-hidden="true">‹</span>
                                </li>
                              @else
                              <li class="page-item" >
                                <a class="page-link" style="cursor:pointer !important" aria-label="« Previous" onclick="submitpagefilter('{{$prev_page}}')" >‹</a>
                                </li>
                                @endif
                            
                                @if ($is_next_page_disabled==1)
                                <li class="page-item disabled" aria-disabled="true" aria-label="Next »">
                                <span class="page-link" aria-hidden="true">›</span>
                                </li>
                                @else
                                <li class="page-item">
                                     <a class="page-link" aria-label="Next »" style="cursor:pointer !important" rel="next" 
                                     onclick="submitpagefilter('{{$next_page}}')"
                                     >›</a>
                                </li>
                                @endif
                           
                      </ul>
                       </nav>
                    </div>
                   