<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author'];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    private function dateRangeFilter(Builder $query, $from = null, $to = null)
    {
        if ($from && !$to) {
            return $query->where('created_at', '>=', $from);
        }
        if (!$from && $to) {
            return $query->where('created_at', '<=', $to);
        }
        if ($from && $to) {
            return $query->whereBetween('created_at', [$from, $to]);
        }
    }
    // Tìm theo tiêu đề
    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }
    //Số bình luận
    public function scopeWithReviewCount(Builder $query, $from = null, $to = null)
    {
        return $query->withCount([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ]);
    }
    //Trung bình đánh giá
    public function scopeWithAvgRating(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withAvg([
            'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
        ], 'rating');
    }
    // Phổ biến (nhiều bình luận nhất)
    public function scopePopular(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withReviewCount($from, $to)
            ->orderBy('reviews_count', 'desc');
    }
    // Đánh giá cao nhất
    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder
    {
        return $query->withAvgRating($from, $to)
            ->orderBy('reviews_avg_rating', 'desc');
    }
    //Đánh giá thấp nhất
    public function scopeMinReviews(Builder $query, int $minReviews): Builder
    {
        return $query->having('reviews_count', '>=', $minReviews);
    }
    //Phổ biến nhất tháng
    public function scopePopularLastMonth(Builder $query): Builder
    {
        return $query->popular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
            ->minReviews(2);
    }
    //Phổ biến trong 6 tháng
    public function scopePopularLast6Months(Builder $query): Builder
    {
        return $query->popular(now()->subMonths(6), now())
            ->highestRated(now()->subMonths(6), now())
            ->minReviews(5);
    }
    //Đánh giá cao nhất trong tháng
    public function scopeHighestRatedLastMonth(Builder $query): Builder
    {
        return $query->highestRated(now()->subMonth(), now())
            ->popular(now()->subMonth(), now())
            ->minReviews(2);
    }
    // Đánh giá cao nhất trong 6 tháng
    public function scopeHighestRatedLast6Months(Builder $query): Builder
    {
        return $query->highestRated(now()->subMonths(6), now())
            ->popular(now()->subMonths(6), now())
            ->minReviews(5);
    }
}
