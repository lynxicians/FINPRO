 @extends('layout.layout')
 
 @section('content')
<div class="home-wrapper">
  <div class="hero-background">
    <div class="search-wrapper">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
        <button class="btn btn-outline-secondary button-search" type="button" id="button-addon1">Search</button>
      </div>
    </div>
    <div class="hero-wrapper">
      <div class="desc">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae deleniti ipsam nobis necessitatibus facere! Voluptatem modi, qui iure fuga minus unde delectus at. Omnis culpa necessitatibus quod aspernatur molestiae quis! Ipsam vitae ullam iste aspernatur pariatur sequi aperiam! Quae, obcaecati eos, amet ipsum repellendus velit est consectetur, quaerat fuga error et esse! Culpa voluptate, labore velit quaerat cum commodi a, voluptatibus maxime nostrum facere, aut quae molestiae accusantium adipisci quisquam dolorem optio sed iste. Unde deleniti soluta, laboriosam expedita minima omnis voluptas! Exercitationem harum aperiam nesciunt dolorum dolores illo sint, quas dolorem atque! Dolorum nisi placeat hic amet officiis in!</div>
      <div class="bottom-wrapper">
        <div class="like"><i class='bx bx-like'></i></div>
        <div class="comment"><i class='bx bx-comment-dots'></i></div>
        <div class="date">2023-07-21</div>
      </div>
    </div>
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

  
  {{-- @foreach ($content as $item)
  <div class="content-wrapper">
    <div class="circle-profile"></div>
    <div class="low-desc">
      <div class="head">{{ $item->title }}</div>
      <div class="body">{{ $item->description }}</div>
      <div class="bottom-wrappers">
        <div class="like"><i class='bx bx-like'></i></div>
        <div class="comment"><i class='bx bx-comment-dots'></i></div>
        <div class="date">{{!! $item->content !!}}</div>
      </div>
    </div>
  </div>
@endforeach --}}

 </div>
 <div class="content-container">
  <hr class="border-2">
  @foreach ($content as $index => $item)
  @if ($index % 2 == 0)
  <a href="{{ route('suggestion.show', ['id' => $item->id]) }}" class="text-dark">
    <div class="content-wrapper">
      <div class="circle-profile"></div>
      <div class="low-desc">
        <div class="purple w-100">
          <div class="head">{{ $item->title }}</div>
        </div>
        <div class="pink w-100">
          <div class="body">{!! $item->first_paragraph !!}
                @if (str_word_count(strip_tags($item->content)) > 100)
                ...
                @endif
          </div>
        </div>
        <div class="pink-bottom">
          <div class="bottom-wrappers">
            <div class="like"><i class='bx bx-like'></i></div>
            <div class="comment"><i class='bx bx-comment-dots'></i></div>
            <div class="date">{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}</div>
          </div>
        </div>
      </div>
    </div>
  </a>
  @else
  <a href="{{ route('suggestion.show', ['id' => $item->id]) }}" class="text-dark">
    <div class="content-wrapper d-flex justify-content-end ms-auto">
      <div class="low-desc">
        <div class="purple w-100">
          <div class="head">{{ $item->title }}</div>
        </div>
        <div class="pink w-100">
          <div class="body">{!! $item->first_paragraph !!}
                @if (str_word_count(strip_tags($item->content)) > 100)
                ...
                @endif
          </div>
        </div>
        <div class="pink-bottom">
          <div class="bottom-wrappers">
            <div class="like"><i class='bx bx-like'></i></div>
            <div class="comment"><i class='bx bx-comment-dots'></i></div>
            <div class="date">{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i') }}</div>
          </div>
        </div>
      </div>
      <div class="circle-profile"></div>
    </div>
  </a>
  @endif
@endforeach
 </div>
 @endsection