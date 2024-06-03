<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Education;
use App\Models\Experience;

class ProfileController extends Controller
{
    // Recruiter
    public function index()
    {
        $user = Auth::user();
        return view('recruiter.profile', ['user' => $user]);
    }

    public function detailProfile()
    {
        $user = Auth::user();
        return view('recruiter.detailProfile', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'company_name' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoName = time() . '.' . $profilePhoto->getClientOriginalExtension();
            $profilePhoto->move(public_path('images/profile'), $profilePhotoName);
            $user->profile_photo = $profilePhotoName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->company_name = $request->company_name;
        $user->save();

        return redirect()->route('recruiter.profile')->with('success', 'Profile updated successfully.');
    }

    // Applicant - Profile
    public function applicantProfile()
    {
        $user = Auth::user();
        $education = $user->education ?? collect(); // Memastikan $education tidak null
        return view('applicant.profile', ['user' => $user, 'education' => $education]);
    }

    public function applicantDetailProfile()
    {
        $user = Auth::user();
        $education = $user->education ?? collect(); // Memastikan $education tidak null
        return view('applicant.detailProfile', ['user' => $user, 'education' => $education]);
    }

    public function updateApplicantProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoName = time() . '.' . $profilePhoto->getClientOriginalExtension();
            $profilePhoto->move(public_path('images/profile'), $profilePhotoName);
            $user->profile_photo = $profilePhotoName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Handle education data
        $educationData = $request->input('education');
        foreach ($educationData as $edu) {
            if (isset($edu['id'])) {
                $education = Education::find($edu['id']);
                if ($education && $education->user_id == $user->id) {
                    $education->update($edu);
                }
            } else {
                $user->education()->create($edu);
            }
        }

        return redirect()->route('applicant.profile')->with('success', 'Profile updated successfully.');
    }

    // Recruiter - Educations
    public function educationProfile()
    {
        $user = Auth::user();
        return view('applicant.educationProfile', ['user' => $user]);
    }

    public function storeEducation(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $user->education()->create($request->all());

        return redirect()->route('applicant.profile')->with('success', 'Education added successfully.');
    }

    public function editEducation($id)
    {
        $user = Auth::user();
        $education = $user->education()->findOrFail($id);

        return view('applicant.editEducation', ['user' => $user, 'education' => $education]);
    }

    public function updateEducation(Request $request, $id)
    {
        $user = Auth::user();
        $education = $user->education()->findOrFail($id);

        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $education->update($request->all());

        return redirect()->route('applicant.profile')->with('success', 'Education updated successfully.');
    }
    public function deleteEducation($id)
    {
        $user = Auth::user();
        $education = Education::find($id);

        if ($education && $education->user_id == $user->id) {
            $education->delete();
            return redirect()->route('applicant.profile')->with('success', 'Education deleted successfully.');
        }

        return redirect()->route('applicant.profile')->with('error', 'Education not found or you do not have permission to delete it.');
    }

    // Applicant - Experience
    public function experienceProfile()
    {
        $user = Auth::user();
        return view('applicant.experienceProfile', ['user' => $user]);
    }

    public function storeExperience(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $user->experience()->create([
            'job_title' => $request->input('job_title'),
            'company' => $request->input('company'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->route('applicant.profile')->with('success', 'Pengalaman kerja berhasil ditambahkan.');
    }

    public function editExperience($id)
    {
        $user = Auth::user();
        $experience = $user->experience()->findOrFail($id);

        return view('applicant.editExperience', ['user' => $user, 'experience' => $experience]);
    }

    public function updateExperience(Request $request, $id)
    {
        $user = Auth::user();
        $experience = $user->experience()->findOrFail($id);

        $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $experience->update($request->all());

        return redirect()->route('applicant.profile')->with('success', 'Pengalaman kerja berhasil diperbarui.');
    }

    public function deleteExperience($id)
    {
        $user = Auth::user();
        $experience = Experience::find($id);

        if ($experience && $experience->user_id == $user->id) {
            $experience->delete();
            return redirect()->route('applicant.profile')->with('success', 'Pengalaman kerja berhasil dihapus.');
        }

        return redirect()->route('applicant.profile')->with('error', 'Pengalaman kerja tidak ditemukan atau Anda tidak memiliki izin untuk menghapusnya.');
    }

}
