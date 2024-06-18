<?php

namespace App\Observers;

use App\Models\Book;

class BookObserver
{
    /**
     * Handle the Book "created" event.
     */
    public function created(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "updated" event.
     */
    public function updated(Book $book): void
    {
        //
    }
    public function saved(Book $book): void
    {
        foreach ($book->publications as $publication) {
            $recipe = $publication->recipe;

            if ($book->published_at) {
                $recipe->published = true;

            } else {
                $this->updateRecipePublicationStatus($recipe);
            }

            $recipe->save();
        }
    }

    public function deleting(Book $book): void
    {
        foreach ($book->publications as $publication) {
            $recipe = $publication->recipe;

            $this->updateRecipePublicationStatus($recipe);
            $recipe->save();
        }
    }

    private function updateRecipePublicationStatus($recipe): void
    {
        $activePublications = $recipe->publications->filter(function ($publication) {
            return $publication->book->published_at !== null;
        });

        $recipe->published = $activePublications->isNotEmpty();
    }

    /**
     * Handle the Book "deleted" event.
     */
    public function deleted(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "restored" event.
     */
    public function restored(Book $book): void
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     */
    public function forceDeleted(Book $book): void
    {
        //
    }
}
