<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\HandlesFileUploads;

/**
 * Base class for all admin controllers.
 * Provides shared traits and helpers. Adding a new resource controller
 * simply means extending this class and using the provided trait methods.
 */
abstract class BaseAdminController extends Controller
{
    use HandlesFileUploads;
}
