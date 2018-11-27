<?php

namespace App\Repositories;

use App\Models\LeaveCredit;
use DB;

class LeaveCreditRepository extends BaseRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(LeaveCredit $leaveCredit)
    {
        $this->model = $leaveCredit;
    }

    public function getRemainingLeavesPerType($user_id)
    {
        $year = date('Y', strtotime('now'));
        return DB::table('leave_credits')
                ->join('leave_types', 'leave_credits.leave_type_id', '=', 'leave_types.id')  
                ->where('leave_credits.user_id', $user_id)
                ->where('leave_credits.is_approve', 1)
                ->whereYear('leave_credits.to', $year)
                ->groupBy('leave_credits.leave_type_id')
                ->select('leave_types.name', 'leave_types.code', DB::raw('SUM(num_of_days) as remaining_leave'))
                ->get();
    }

    // public function getAll()
    // {
    //     $this->leaveCreditRepo->orderBy('from', 'desc')->get();
    // }

    // public function getAllApprove()
    // {
    //     $this->leaveCreditRepo->where('is_approve', 1)
    //                          ->orderBy('from', 'desc')->get();
    // }
}