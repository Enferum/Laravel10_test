<?php

namespace App\Http\Controllers;

use App\Contracts\GameContract;
use App\Contracts\StorageContract;
use App\Services\LinkGeneratorService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function __construct(
        protected LinkGeneratorService $generator,
        protected StorageContract      $storage,
        protected GameContract         $game,
    )
    {
    }

    public function index(): View
    {
        $links = $this->storage->get(Auth::user()->id);

        $this->deleteExpiredLinks($links);

        return view('secret_page', ['links' => $links]);
    }

    public function createLink(): RedirectResponse
    {
        $link = $this->generator->createLink();
        $this->storage->add(Auth::user()->id, $link);

        return redirect()->back();
    }

    public function deleteLink(Request $request): RedirectResponse
    {
        $links = $this->storage->get(Auth::user()->id);
        if (count($links) > 1) {
            $this->storage->remove(Auth::user()->id, $request->get('link'));
            $links = array_diff($links, [$request->get('link')]);

            return redirect($links[0] ?? $links[1]);
        }

        return redirect()->back()->with(['message' => "You can't delete last link"]);
    }

    public function testLuck(): RedirectResponse
    {
        $stack = session('stack', []);

        $results = $this->game->play();
        $stack[] = $results['random_number'];

        if (count($stack) > 3) {
            array_shift($stack);

        }
        session(['stack' => $stack]);

        return redirect()->route('secret_page')->with([
            'result' => $results['result'],
            'random_number' => $results['random_number'],
            'win_result' => $results['win_result'],
        ]);
    }

    public function showHistory(): RedirectResponse
    {
        return redirect()->route('secret_page')->with([
            'stack' => session('stack'),
        ]);
    }

    protected function deleteExpiredLinks(array $links)
    {
        foreach ($links as $link) {
            if (!$this->generator->checkExirationDate($link)) {
                $this->storage->remove(Auth::user()->id, $link);
            }
        }
    }
}
