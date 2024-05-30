<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\LoanRepositoryInterface;
use Illuminate\Http\JsonResponse;

class LoanController extends Controller
{
    public function __construct(private readonly LoanRepositoryInterface $loanRepository)
    {
    }

    public function listUsers(): JsonResponse
    {
        $users = $this->loanRepository->getUserLoans();

        return response()->json([
            'loans' => $users
        ]);
    }

    public function listBooks(): JsonResponse
    {
        $books = $this->loanRepository->getBookLoans();

        return response()->json([
            'loans' => $books
        ]);
    }
}
