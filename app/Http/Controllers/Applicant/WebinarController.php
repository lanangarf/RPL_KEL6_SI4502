namespace App\Http\Controllers;

use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::orderBy('start_datetime', 'desc')->get();
        return view('webinars.index', compact('webinars'));
    }

    public function show($id)
    {
        $webinar = Webinar::findOrFail($id);
        return view('webinars.show', compact('webinar'));
    }
}
