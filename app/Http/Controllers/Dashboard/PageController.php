<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\About;
use App\Faq;
use App\Help;
use Illuminate\Http\Request;
use App\Value;
use Illuminate\Support\Str;
use App\Page;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getAllFaq()
    {
        $data['faq'] = Faq::orderBy('psf_created_at', 'ASC')->get();
        $data['title_page'] = 'Daftar Faq';
        $data['code_page']  = "dashboard_page";
        return view('backup-dashboard.daftar-faq')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFaqPage()
    {
        $data['title_page'] = 'Tambah Faq';
        $data['code_page']  = "addpage";
        return view('backup-dashboard.form-faq')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addFaq(Request $request)
    {
        $data = request()->only('psf_title', 'psf_type_faq', 'psf_icon', 'psf_desc');
        Faq::create($data);
        return redirect()->route('faq.all')->with(['message' => 'Success Add Faq']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function deleteFaq(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faq.all')->with(['message' => 'Success Delete Faq']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function editFaqPage(Faq $faq)
    {
        $data['faq'] = $faq;
        $data['title_page'] = 'Edit Faq';
        $data['code_page']  = "addpage";
        return view('backup-dashboard.form-faq')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function editFaq(Request $request, Faq $faq)
    {
        $faq->update([
            'psf_title' => $request->psf_title,
            'psf_type_faq' => $request->psf_type_faq,
            'psf_icon' => $request->psf_icon,
            'psf_desc' => $request->psf_desc
        ]);
        return redirect()->route('faq.all')->with(['message' => 'Success Edit Faq']);
    }
    public function getAllAbout()
    {
        $data['title_page'] = 'Daftar About';
        $data['about'] = About::orderBy('psa_created_at', 'ASC')->get();
        $data['av'] = Value::all();
        $data['code_page'] = "dashboard_page";
        return view('backup-dashboard.daftar-about')->with($data);
    }
    public function aboutAddPage()
    {
        $data['title_page'] = 'Tambah About';
        $data['code_page']  = "addpage";
        return view('backup-dashboard.form-about')->with($data);
    }
    public function aboutEditPage(About $about)
    {
        $data['title_page'] = 'Edit About';
        $data['about'] = $about;
        $data['code_page']  = "addpage";
        return view('backup-dashboard.form-about')->with($data);
    }
    public function aboutAdd(Request $request)
    {
        $file = $request->file('psa_img_path');
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $path = 'customAuth/img/about/';
        $file->move($path, $nama_file);
        About::create([
            'psa_img_path' => '/img/about/' . $nama_file,
            'psa_title' => $request->psa_title,
            'psa_desc' => $request->psa_desc,
        ]);
        return redirect()->route('about.all')->with(['message' => 'Success Add About']);
    }
    public function aboutEdit(Request $request, About $about)
    {
        if (isset($request->psv_img_path)) {
            $file = $request->file('psa_img_path');
            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $path = 'customAuth/img/about/';
            $file->move($path, $nama_file);
        }
        if (isset($request->psv_img_path)) {
            $about->update([
                'psa_img_path' => '/img/about/' . $nama_file,
                'psa_title' => $request->psa_title,
                'psa_desc' => $request->psa_desc,
            ]);
        } else {
            $about->update([
                'psa_title' => $request->psa_title,
                'psa_desc' => $request->psa_desc,
            ]);
        }
        return redirect()->route('about.all')->with(['message' => 'Success Edit About']);
    }
    public function deleteAbout(About $about)
    {
        $about->delete();
        return redirect()->route('about.all')->with(['message' => 'Success Delete About']);
    }
    public function aboutPointAddPage()
    {
        $data['addPoint'] = 10;
        $data['title_page'] = 'Tambah Point About';
        $data['code_page']  = "addpage";
        return view('backup-dashboard.form-about')->with($data);
    }
    public function aboutPointEditPage(Value $value)
    {
        $data['editPoint'] = 10;
        $data['code_page']  = "addpage";
        $data['value'] = $value;
        $data['title_page'] = 'Edit Point About';
        return view('backup-dashboard.form-about')->with($data);
    }
    public function aboutPointAdd(Request $request)
    {
        $point = Str::slug($request->psv_title, '-');
        $file = $request->file('psv_img_path');
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // isi dengan nama folder tempat kemana file diupload
        $path = 'customAuth/img/about/' . $point . '/';
        if (!is_dir('customAuth/img/about/' . $point)) {
            mkdir('./customAuth/img/about/' . $point, 0777, TRUE);
        }
        $file->move($path, $nama_file);
        Value::create([
            'psv_img_path' => '/img/about/' . $point . '/' . $nama_file,
            'psv_title' => $request->psv_title,
            'psv_desc' => $request->psv_desc
        ]);
        return redirect()->route('about.all')->with(['message' => 'Success Add About Point']);
    }
    public function aboutPointEdit(Request $request, Value $value)
    {
        if (isset($request->psv_img_path)) {
            $point = Str::slug($request->psv_title, '-');
            $file = $request->file('psv_img_path');
            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $path = 'customAuth/img/about/' . $point . '/';
            if (!is_dir('customAuth/img/about/' . $point)) {
                mkdir('./customAuth/img/about/' . $point, 0777, TRUE);
            }
            $file->move($path, $nama_file);
        }
        if (isset($request->psv_img_path)) {
            $value->update([
                'psv_img_path' => '/img/category/' . $point . '/' . $nama_file,
                'psv_title' => $request->psv_title,
                'psv_desc' => $request->psv_desc
            ]);
        } else {
            $value->update([
                'psv_title' => $request->psv_title,
                'psv_desc' => $request->psv_desc
            ]);
        }
        return redirect()->route('about.all')->with(['message' => 'Success Edit About Point']);
    }
    public function deletePoint(Value $value)
    {
        $value->delete();
        return redirect()->back()->with(['message' => 'Success Delete About Point']);
    }
    public function getAllHelp()
    {
        $data['code_page'] = "dashboard_page";
        $data['help'] = Help::orderBy('psh_created_at', 'ASC')
            ->get();
        $data['title_page'] = 'Daftar Help';
        return view('backup-dashboard.daftar-help')->with($data);
    }
    public function deleteHelp(Help $help)
    {
        $help->delete();
        return redirect()->back()->with(['message' => 'Success Delete Help']);
    }
    public function addHelpPage()
    {
        $data['code_page']  = "addpage";
        $data['title_page'] = 'Tambah Help';
        return view('backup-dashboard.form-help')->with($data);
    }
    public function editHelpPage(Help $help)
    {
        $data['help'] = $help;
        $data['title_page'] = 'Edit Help';
        $data['code_page']  = "addpage";
        return view('backup-dashboard.form-help')->with($data);
    }
    public function addHelp(Request $request)
    {
        $data = $request->only('psh_title', 'psh_type_faq', 'psh_icon', 'psh_desc');
        Help::create($data);
        return redirect()->route('help.all')->with(['message' => 'Success Add Help']);
    }
    public function editHelp(Request $request, Help $help)
    {
        $help->update([
            'psh_title' => $request->psh_title,
            'psh_type_faq' => $request->psh_type_faq,
            'psh_icon' => $request->psh_icon,
            'psh_desc' => $request->psh_desc
        ]);
        return redirect()->route('help.all')->with(['message' => 'Success Edit Help']);
    }
    public function getAllPage()
    {
        $data['code_page']  = "dashboard_page";
        $data['page'] = Page::where('pp_status', false)->get();
        $data['title_page'] = 'Daftar Halaman';
        return view('backup-dashboard.daftar-halaman')->with($data);
    }
    public function deletePage(Page $page)
    {
        $page->update([
            'pp_status' => true
        ]);
        $page->delete();
        return redirect()->back()->with(['message' => 'Succes Delete Page']);
    }
    public function addPage()
    {
        $data['title_page'] = 'Tambah Halaman';
        $data['code_page']  = "addpage";
        return view('backup-dashboard.form-halaman')->with($data);
    }
    public function editPage(Page $page)
    {
        $data['page'] = $page;
        $data['title_page'] = 'Edit Halaman';
        $data['code_page']  = "addpage";
        return view('backup-dashboard.form-halaman')->with($data);
    }
    public function storePage(Request $request)
    {
        $slug = Str::slug($request->pp_title, '-');
        if (isset($request->pp_img_path)) {
            $file = $request->file('pp_img_path');
            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $path = 'customAuth/img/info/';
            $file->move($path, $nama_file);
            Page::create([
                'pp_img_path' => '/img/info/' . $nama_file,
                'pp_title' => $request->pp_title,
                'pp_slug' => $slug,
                'pp_content' => $request->pp_content,
                'pp_id_user' => Auth::user()->pu_id
            ]);
        } else {
            Page::create([
                'pp_title' => $request->pp_title,
                'pp_slug' => $slug,
                'pp_content' => $request->pp_content,
                'pp_id_user' => Auth::user()->pu_id
            ]);
        }
        return redirect()->route('page.all')->with(['message' => 'Success Add Page']);
    }
    public function updatePage(Request $request, Page $page)
    {
        $slug = Str::slug($request->pp_title, '-');
        if (isset($request->pp_img_path)) {
            $file = $request->file('pp_img_path');
            $nama_file = time() . "_" . $file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $path = 'customAuth/img/info/';
            $file->move($path, $nama_file);
            $page->update([
                'pp_img_path' => '/img/info/' . $nama_file,
                'pp_title' => $request->pp_title,
                'pp_slug' => $slug,
                'pp_content' => $request->pp_content,
                'pp_id_user' => Auth::user()->pu_id
            ]);
        } else {
            $page->update([
                'pp_title' => $request->pp_title,
                'pp_slug' => $slug,
                'pp_content' => $request->pp_content,
                'pp_id_user' => Auth::user()->pu_id
            ]);
        }
        return redirect()->route('page.all')->with(['message' => 'Success Add Page']);
    }
}
