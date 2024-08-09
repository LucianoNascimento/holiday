<?php

namespace App\Http\Controllers;

use App\Models\HolidayPlan;
use Barryvdh\DomPDF\Facade\Pdf as Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HolidayPlanController extends Controller
{
    public function index()
    {
        $holidayPlans = HolidayPlan::all();
        return response()->json([
            'message' => 'Holiday plans retrieved successfully.',
            'data' => $holidayPlans
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|date_format:Y-m-d',
            'location' => 'required|string|max:255',
            'participants' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $holidayPlan = HolidayPlan::create($request->all());
        return response()->json([
            'message' => 'Holiday plan created successfully.',
            'data' => $holidayPlan
        ], 201);
    }

    public function show($id)
    {
        $holidayPlan = HolidayPlan::findOrFail($id);
        return response()->json([
            'message' => 'Holiday plan retrieved successfully.',
            'data' => $holidayPlan
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date|date_format:Y-m-d',
            'location' => 'required|string|max:255',
            'participants' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $holidayPlan = HolidayPlan::findOrFail($id);
        $holidayPlan->update($request->all());
        return response()->json([
            'message' => 'Holiday plan updated successfully.',
            'data' => $holidayPlan
        ], 200);
    }

    public function destroy($id)
    {
        HolidayPlan::destroy($id);
        return response()->json([
            'message' => 'Holiday plan deleted successfully.'
        ], 204);
    }

    public function generatePdf($id)
    {
        $holidayPlan = HolidayPlan::findOrFail($id);

        $pdf = Pdf::loadView('pdf.holiday_plan', compact('holidayPlan'));

        return $pdf->download('holiday_plan.pdf');
    }
}
