@extends('layouts.app')

@section('content')
  <div class="mb-4 bg-gray-50 rounded-md shadow-lg ring-1 ring-black">
    <h1 class="mb-2 text-2xl px-2 py-2 text-violet-700 font-semibold">📖{{ $book->title }}</h1>

    <div class="book-info px-2 py-2">
      <div class="book-author mb-4 text-lg font-semibold">✍🏻by {{ $book->author }}</div>
      <div class="book-rating flex items-center">
        <div class="mr-2 text-sm font-medium text-yellow-500">
          <x-star-rating :rating="$book->reviews_avg_rating"/>
        </div>
        <span class="book-review-count text-sm text-gray-500">
          {{ $book->reviews_count }} {{ Str::plural('review',$book->reviews_count ) }}
        </span>
      </div>
    </div>
  </div>

  <div class="mb-4">
    <a href="{{ route('books.reviews.create', $book) }}" class="reset-link">
      Add a review!</a>
  </div>

  <div>
    <div class="flex mb-4">
      <h2 class="text-xl font-semibold">Reviews</h2>
      <div class="ml-auto">
        <form action="{{ route('books.show', ['book' => $book->id]) }}" method="GET">
          <div class="relative inline-block">
            <select name="sort" id="sort-by" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
              <option value="latest" @if(request('sort') == 'latest') selected @endif>Latest</option>
              <option value="oldest" @if(request('sort') == 'oldest') selected @endif>Oldest</option>
              <option value="highest" @if(request('sort') == 'highest') selected @endif>Highest Rated</option>
              <option value="lowest" @if(request('sort') == 'lowest') selected @endif>Lowest Rated</option>
            </select>
            
          </div>
          <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50"><i class="fa-solid fa-filter px-2"></i>Sort</button>
        </form>
      </div>
    </div>
    
    
    
</div>
    <ul>
      @forelse ($book->reviews as $review)
        <li class="book-item mb-4">
          <div>
            <div class="mb-2 flex items-center justify-between">
              <div class="font-semibold text-yellow-500">
                <x-star-rating :rating="$review->rating"/>
              </div>
              <div class="book-review-count">
                {{ $review->created_at->format('M j, Y') }}</div>
            </div>
            <p class="text-slate-500 font-semibold">{{ $review->review }}</p>
          </div>
        </li>
      @empty
        <li class="mb-4">
          <div class="empty-book-item">
            <p class="empty-text text-lg font-semibold">No reviews yet</p>
          </div>
        </li>
      @endforelse
    </ul>
  </div>
@endsection