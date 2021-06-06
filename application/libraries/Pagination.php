<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2009, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 */
class CI_Pagination {

//	var $base_url			= ''; // The page we are linking to
//	var $total_rows  		= ''; // Total number of items (database results)
//	var $per_page	 		= 10; // Max number of items you want shown per page
//	var $num_links			=  2; // Number of "digit" links to show before/after the currently viewed page
//	var $cur_page	 		=  1; // The current page being viewed
//	var $first_link   		= '<<';
//	var $next_link			= '&gt;';
//	var $prev_link			= '&lt;';
//	var $last_link			= '>>';
//	var $uri_segment		= 3;
//	var $full_tag_open		= '<div class="paging">';
//	var $full_tag_close		= '</div>';
//	var $first_tag_open		= '<div>';
//	var $first_tag_close	= '</div>';
//	var $last_tag_open		= '<div>';
//	var $last_tag_close		= '</div>';
//	var $cur_tag_open		= '<div style="color: #0088cc;"><b>';
//	var $cur_tag_close		= '</b></div>';
//	var $next_tag_open		= '<div>';
//	var $next_tag_close		= '</div>';
//	var $prev_tag_open		= '<div>';
//	var $prev_tag_close		= '</div>';
//	var $num_tag_open		= '<div>';
//	var $num_tag_close		= '</div>';
//	var $page_query_string	= FALSE;
//	var $query_string_segment = 'per_page';

    var $base_url			= ''; // The page we are linking to
    var $total_rows  		= ''; // Total number of items (database results)
    var $per_page	 		= 10; // Max number of items you want shown per page
    var $num_links			=  2; // Number of "digit" links to show before/after the currently viewed page
    var $cur_page	 		=  1; // The current page being viewed
    var $suffix				= ''; // The page we are linking to
    var $first_link   		= '';
    var $next_link			= '';
    var $prev_link			= '';
    var $last_link			= '';
    var $uri_segment		= 3;
    var $full_tag_open		= '<div class="page">';
    var $full_tag_close		= ' </div>';
    var $first_tag_open		= '<li class="page-num-item page-num-left page-num-double-left">';
    var $first_tag_close	= '</li>';
    var $last_tag_open		= '<li class="page-num-item page-num-right page-num-double-right">';
    var $last_tag_close		= '</li>';
    var $cur_tag_open		= ' <li class="page-num-item active"><a href="#" class="page-num-link">';
    var $cur_tag_close		= '</a></li> ';
    var $next_tag_open		= '<li class="page-num-item page-num-right">';
    var $next_tag_close		= '</li>';
    var $prev_tag_open		= '<li class="page-num-item page-num-left">';
    var $prev_tag_close		= '</li>';
    var $num_tag_open		= ' <li class="page-num-item">';
    var $num_tag_close		= '</li> ';
    var $page_query_string	= FALSE;
    var $query_string_segment = 'per_page';

    /**
     * Constructor
     *
     * @access	public
     * @param	array	initialization parameters
     */
    function __construct($params = array())
    {
        if (count($params) > 0)
        {
            $this->initialize($params);
        }

        log_message('debug', "Pagination Class Initialized");
    }

    // --------------------------------------------------------------------

    /**
     * Initialize Preferences
     *
     * @access	public
     * @param	array	initialization parameters
     * @return	void
     */
    function initialize($params = array())
    {
        if (count($params) > 0)
        {
            foreach ($params as $key => $val)
            {
                if (isset($this->$key))
                {
                    $this->$key = $val;
                }
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Generate the pagination links
     *
     * @access	public
     * @return	string
     */
    function create_links()
    {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 OR $this->per_page == 0)
        {
            return '';
        }

        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);

        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1)
        {
            return '';
        }

        // Determine the current page number.
        $CI =& get_instance();

		$url =$_SERVER["PHP_SELF"];//2021-03-21 코드 변경
		$url = explode('/',$url);

        if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
        {
            if ($CI->input->get($this->query_string_segment) != 0)
            {
                $this->cur_page = $CI->input->get($this->query_string_segment);

                // Prep the current page - no funny business!
                $this->cur_page = (int) $this->cur_page;
            }
			$this->cur_page = isset($url[5])?$url[5]:1;//2021-03-21 추가
        }
        else
        {
            if ($CI->uri->segment($this->uri_segment) != 0)
            {
                $this->cur_page = $CI->uri->segment($this->uri_segment);

                // Prep the current page - no funny business!
                $this->cur_page = (int) $this->cur_page;
            }
			$this->cur_page = isset($url[5])?$url[5]:1;//2021-03-21 추가
        }

        $this->num_links = (int)$this->num_links;

        if ($this->num_links < 1)
        {
            show_error('Your number of links must be a positive number.');
        }

        if ( ! is_numeric($this->cur_page))
        {
            $this->cur_page = 1;
        }

        if ( $this->cur_page > 1000)
        {
            $this->cur_page = 1;
        }

        // Is the page number beyond the result range?
        // If so we show the last page
        if ($this->cur_page > $num_pages) {
            $this->cur_page = $num_pages;
        }


        $uri_page_number = $this->cur_page;
        //$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);

        // Calculate the start and end numbers. These determine
        // which number to start and end the digit links with
//		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
//		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        $disp_page = ceil($this->cur_page / $this->num_links) * 5;
        $end   =  $disp_page < $num_pages ? $disp_page : $num_pages ;
        $start = ((int)$disp_page - 4);

        // Is pagination being used over GET or POST?  If get, add a per_page query
        // string. If post, add a trailing slash to the base URL if needed
        if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
        {
            $this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
        }
        else
        {
            $this->base_url = rtrim($this->base_url, '/') .'/';
        }

        // And here we go...
        $output = '';

        $output .= ' <ul class="page-num-list">';
//		 Render the "First" link
        if  ( $this->cur_page  > ($this->num_links + 1))
        {
            $output .= $this->first_tag_open.'<a href="'.$this->base_url.$this->suffix.'" class="page-num-link">'.$this->first_link.'</a>'.$this->first_tag_close;
        }

        // Render the "previous" link
        if  ($this->cur_page != 1)
        {
            $i = $uri_page_number - 1;
//			$i = $disp_page - 10;
            if ($i == 0) $i = '';
            $output .= $this->prev_tag_open.'<a href="'.$this->base_url.$i.$this->suffix.'" class="page-num-link">'.$this->prev_link.'</a>'.$this->prev_tag_close;
        }

        // Write the digit links
//		for ($loop = $start -1; $loop <= $end; $loop++)
        for ($loop = $start; $loop <= $end; $loop++)
        {
            $i = ($loop * $this->per_page) - $this->per_page;

            if ($i >= 0)
            {
                if ($this->cur_page == $loop)
                {
                    $output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
                }
                else
                {
                    //$n = ($i == 0) ? '' : $i;
                    $output .= $this->num_tag_open.'<a href="'.$this->base_url.$loop.$this->suffix.'" class="page-num-link">'.$loop.'</a>'.$this->num_tag_close;
                }
            }
        }

        // Render the "next" link
        if ($this->cur_page < $num_pages)
		if ($disp_page < $num_pages)
        {
            $output .= $this->next_tag_open.'<a href="'.$this->base_url.($this->cur_page + 1).$this->suffix.'" class="page-num-link">'.$this->next_link.'</a>'.$this->next_tag_close;
			$output .= $this->next_tag_open.'<a href="'.$this->base_url.($disp_page + 1).$this->suffix.'" class="page_next">'.$this->next_link.'</a>'.$this->next_tag_close;
        }

//		 Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages)
        {
            //$i = (($num_pages * $this->per_page) - $this->per_page);
            $output .= $this->last_tag_open.'<a href="'.$this->base_url.$num_pages.$this->suffix.'" class="page-num-link">'.$this->last_link.'</a>'.$this->last_tag_close;
        }
        $output .= '</ul> ';

        // Kill double slashes.  Note: Sometimes we can end up with a double slash
        // in the penultimate link so we'll kill all double slashes.
        $output = preg_replace("#([^:])//+#", "\\1/", $output);

        // Add the wrapper HTML if exists
        $output = $this->full_tag_open.$output.$this->full_tag_close;

        return $output;
    }
}
// END Pagination Class

/* End of file Pagination.php */
/* Location: ./system/libraries/Pagination.php */
