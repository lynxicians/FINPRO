 @extends('layout.layout')
 
 @section('content')
<div class="home-wrapper">
  <div class="hero-background">
    <div class="search-wrapper">
      <form action="{{ route("search-suggestion") }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="title" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="{{ request('title') }}">
            <button class="btn btn-outline-secondary button-search" type="submit" id="button-addon1">Search</button>
        </div>
      </form>
    </div>
    <div class="hero-wrapper">
      <div class="desc">Your words possess the extraordinary potential to ignite a profound wave of transformation across the campus landscape. In a realm where silence can be deafening, your concerns deserve to be heard, acknowledged, and acted upon. Today, we invite you to embrace the opportunity to be the driving force behind this transformative journey. By becoming an active participant in CampusVoice, you assume the role of a catalyst – a dynamic agent of change that has the capacity to shape the trajectory of student voices into an impactful chorus of transformation. As we stand at the crossroads of progress, remember that your campus is not just a physical space; it's a tapestry woven from the threads of every voice that resonates within it. Join CampusVoice today, and together, let's embark on a mission to reshape the future, one resounding voice at a time. Your campus, your voice – a harmonious symphony of change awaits.</div>
      {{-- <div class="bottom-wrapper">
        <div class="like"><i class='bx bx-like'></i></div>
        <div class="comment"><i class='bx bx-comment-dots'></i></div>
        <div class="date">2023-07-21</div>
      </div> --}}
    </div>
    {{-- <div class="button-suggestionDone text-center mt-4">
      <a class="btn btn-lg shadow text-dark" href="#" role="button">What We have done?</a>
    </div> --}}
  </div>

{{-- 
  <div class="content-wrapper d-flex justify-content-end ms-auto">
    <div class="low-desc">
      <div class="head">SEO?</div>
      <div class="body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit dolorem ullam, ab, quidem quisquam a quis maiores ipsum commodi mollitia natus quia, nobis cum omnis. Qui, mollitia? Harum adipisci perspiciatis, labore beatae repudiandae, optio maiores voluptas veniam eaque officia laborum libero iusto quisquam. Deleniti nobis rerum modi accusamus, quia commodi!</div>
      <div class="bottom-wrappers">
        <div class="like"><i class='bx bx-like'></i></div>
        <div class="comment"><i class='bx bx-comment-dots'></i></div>
        <div class="date">2023-07-21</div>
      </div>
    </div>
    <div class="circle-profile"></div>
  </div> --}}
 </div>
 <div class="content-container">
  <hr class="border-2">
    @if(isset($content))
    <div class="row g-5">
      @foreach ($content as $index => $item)
          <div class="col-4">
            <div class="content-wrapper">
              {{-- <div class="circle-profile"></div> --}}
                <div class="low-desc">
                  <div class="purple w-100">
                    <div class="head">{{ $item->title }}</div>
                  </div>
                <a href="{{ route('suggestion.show', ['id' => $item->id]) }}" class="text-dark">
                  <div class="pink w-100">
                    <div class="body">{!! $item->first_paragraph !!}
                          @if (str_word_count(strip_tags($item->content)) > 100)
                          ...
                          @endif
                    </div>
                  </div>
                </a>
                  <div class="pink-bottom">
                    <div class="bottom-wrappers">
                      <form action="{{ route('suggestion.like', ['id' => $item->id]) }}" method="POST">
                          @csrf
                            <input type="hidden" value="{{ $item->id }}" name="suggestion_id">
                          <button type="submit" class="like-button btn">
                              <i class="bx bx-like"></i> {{ $item->likes_count }}
                          </button>
                      </form>
                      <a href="{{ route('suggestion.show', ['id' => $item->id]) }}" class="text-dark">
                        <div class="comment"><i class='bx bx-comment-dots'></i></div>
                      </a>
                      <div class="date">{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}</div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
      @endforeach
    </div>
    @else
      @if (isset($foundBlog))
      <h2>Suggestion: </h2>
      <div class="row g-5">
        <div class="col-4">
          <div class="content-wrapper">
            {{-- <div class="circle-profile"></div> --}}
              <div class="low-desc">
                <div class="purple w-100">
                  <div class="head">{{ $foundBlog->title }}</div>
                </div>
              <a href="{{ route('suggestion.show', ['id' => $foundBlog->id]) }}" class="text-dark">
                <div class="pink w-100">
                  <div class="body">{!! $foundBlog->first_paragraph !!}
                        @if (str_word_count(strip_tags($foundBlog->content)) > 100)
                        ...
                        @endif
                  </div>
                </div>
              </a>
                <div class="pink-bottom">
                  <div class="bottom-wrappers">
                    <form action="{{ route('suggestion.like', ['id' => $foundBlog->id]) }}" method="POST">
                        @csrf
                          <input type="hidden" value="{{ $foundBlog->id }}" name="suggestion_id">
                        <button type="submit" class="like-button btn">
                            <i class="bx bx-like"></i> {{ $foundBlog->likes_count }}
                        </button>
                    </form>
                    <a href="{{ route('suggestion.show', ['id' => $foundBlog->id]) }}" class="text-dark">
                      <div class="comment"><i class='bx bx-comment-dots'></i></div>
                    </a>
                    <div class="date">{{ \Carbon\Carbon::parse($foundBlog->created_at)->format('Y-m-d H:i') }}</div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>    
      @else
      <h2>Suggestion not found </h2>
      <p>Keyword: {{ $keyword }}</p>
      @endif
      @if(isset($foundBlog))
        @else
        <h2>Related Suggestions: </h2>
      @endif
      <div class="row g-5">
      @foreach ($matchingSuggestions as $index => $item)
        <div class="col-4">
          <div class="content-wrapper">
            {{-- <div class="circle-profile"></div> --}}
              <div class="low-desc">
                <div class="purple w-100">
                  <div class="head">{{ $item->title }}</div>
                </div>
              <a href="{{ route('suggestion.show', ['id' => $item->id]) }}" class="text-dark">
                <div class="pink w-100">
                  <div class="body">{!! $item->first_paragraph !!}
                        @if (str_word_count(strip_tags($item->content)) > 100)
                        ...
                        @endif
                  </div>
                </div>
              </a>
                <div class="pink-bottom">
                  <div class="bottom-wrappers">
                    <form action="{{ route('suggestion.like', ['id' => $item->id]) }}" method="POST">
                        @csrf
                          <input type="hidden" value="{{ $item->id }}" name="suggestion_id">
                        <button type="submit" class="like-button btn">
                            <i class="bx bx-like"></i> {{ $item->likes_count }}
                        </button>
                    </form>
                    <a href="{{ route('suggestion.show', ['id' => $item->id]) }}" class="text-dark">
                      <div class="comment"><i class='bx bx-comment-dots'></i></div>
                    </a>
                    <div class="date">{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}</div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    @endforeach
  </div>
    @endif
 </div>
 @endsection