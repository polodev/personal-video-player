<?php
namespace Database\Seeders;


use App\Series;
use App\Topic;
use Illuminate\Database\Seeder;

class ManualSeriesAndTopicsSeeder extends Seeder
{

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $series_and_topics_list = $this->series_and_topics_list1();
    $series_list = $series_and_topics_list['series_list'];
    $topics = $series_and_topics_list['topics'];
    $this->generate_topics($topics);
    $this->generate_series($series_list);
    
  }
  public function generate_series( $series_list ) {
    Series::truncate();
    foreach($series_list as $series) {
      // generate a series
      $new_series = Series::create([
        'title' => $series['title'],
        'url'   => $series['url'],
      ]);
      // find topic id from topics table 
      $topic = Topic::where('title', $series['topic_title'])->first();
      
      if (!is_null($topic)) {
          $new_series->topics()->attach( $topic );
      }
    }
  }
  public function generate_topics( $topics ) {
    Topic::truncate();
    foreach($topics as $topic) {
      Topic::create(['title' => $topic ]);
    }
  }

  public function series_and_topics_list1(){
    $tuts_folder = '/home/polo/tuts';
    $tuts_folder = 'C:/Users/Polo Dev/Pictures/tuts';
    $outer_folders = [
      "code-course" => [
        "Build a classified ads site",
        "Build a File Marketplace with Laravel",
        "code_course_laravel_nuxt_cart",
        "Drag and drop sorting with Laravel",
        "Eloquent By Example",
        "filtering-in-laravel",
        "filtering-in-laravel-blade",
        "filtering-in-laravel-vue-js",
        "laravel-api-resources",
        "laravel-datatables",
        "Laravel-multi-tenancy-Multi-database",
        "laravel-single-database-multi-tenancy",
        "Learn Vue.js by example",
        "Learn Vuex",
        "nuxt-js-laravel-authentication",
        "Practical-Git",
        "Roles and permissions in Laravel",
        "Tips for cleaner code",
        "Unit testing with PHPUnit",
      ],
      "jeffrey" => [
        "laracasts_code_katas",
        "laracasts_design_patterns_in_php",
        "laracasts_how_do_i",
        "laracasts_how_to_read_code",
        "laracasts_lets_build_a_forum_with_laravel",
        "laracasts_object_oriented_bootcamp",
        "laracasts_solid",
        "laracasts_understand_regular_expressions",
        "laracasts_vue2",
        "laracasts_way_laravel_authentication",
        "laracasts_way_testing_laravel",
      ],
      "linux-academy" => [
        "Linux Academy - Linux Academy Red Hat Certificate of Expertise in Containerized Application Development - Prep Course",
        "Linux Academy - Mastering The Linux Command Line",
        "Linux Academy Nginx And The LEMP Stack",
        "Linux Academy - NGINX Web Server Deep Dive",
        "Linux Academy Red Hat Certified Systems Administrator Prep Course",
        "Linux Academy - Running Container Clusters with Kubernetes",
        "Linux Academy - Using the EC2 Container Service",
      ],
      "pluralsight" => [
        "Docker for Web Developers",
        "[FreeCoursesOnline.Us] Pluralsight - Advanced Node.js",
        "Pluralsight - advanced-redux",
        "Pluralsight - TypeScript In-depth",

      ],
      "tutsplus" => [
        "Agile_Design_Patterns",
        "How to Be a Terminal Pro",
        "TutsPlus Advanced OOP in PHP With Tests",
        "TutsPlus - Build a CMS With Laravel",
        "tutsplus.com - OOP in PHP With Tests ® vampiri6ka",
      ],
      "udemy-backend" => [
        "Introduction to Docker",
        "Udemy - Setup Webserver (Nginx) & a Caching Server(Varnish)",
        "udemy_restful_api_with_laravel_5.4_definitive_guide",
        "Udemy-become-a-wordpress-developer-php-javascript",
      ],
      "udemy-aws" => [
        "Amazon Web Services (AWS) Certified 2019 - 4 Certifications!",
        "Amazon Web Services - Web Hosting & Cloud Computing With AWS",
        "Learn Amazon Web Services easily to become Architect",
      ],
      "udemy-frontend" => [
        "[FreeCourseSite.com] Udemy - React 16 – The Complete Guide (incl. React Router 4 & Redux)",
        "udemy-nodejs-the-complete-guide",
        "udemy_nuxt.js_vue.js_on_steroids",
        "Vue JS 2 - The Complete Guide (incl. Vue Router & Vuex)",
      ],
      "udemy-linux" => [
        "Complete Linux Bash Shell Scripting with Real Life Examples",
        "Learn Linux Shell Scripting – Fundamentals of Bash 4.4",
        "Linux Command Line Interface and BASH Scripting",
        "udemy-complete-linux-training-course-to-get-your-dream-it-job-2019",

      ],
      "udemy-others" => [
        "How to Learn and Memorize the Vocabulary of Any Language",
        "Mastering IELTS Writing Task 2",
        "Morning Routines The Ultimate Morning Routine Guide",
        "UDEMY_IMPROVE_YOUR_ENGLISH_VOCABULARY_WITH_OVER_70_TRICKY_WORDS",
        "udemy-blog-for-a-living-complete-blogging-training-level-1,-2-3",
        "Writing Tips to Instantly Improve Your Writing",
      ],
      "pdftutorial"=> [
        "Angular",
        "blinkist",
        "cms",
        "Frontend",
        "javascript",
        "Laravel",
        "linux",
        "memory",
        "Nodejs",
        "others",
        "Php",
        "php_framework",
        "Programming",
        "python",
        "React",
        "sql",
        "Vue",
        "wordpress",
      ]
    ];

    $series_list = [];
    $topics = [];
    foreach ($outer_folders as $outer_folder_name => $outer_folder_file) {
      foreach ($outer_folder_file as $inner_folder_name) {
        $single_series = [
          'topic_title' => $outer_folder_name,
          'title' => $inner_folder_name,
          'url' => "{$tuts_folder}/{$outer_folder_name}/{$inner_folder_name}",
        ];
        if ( ! in_array($outer_folder_name, $topics) ) {
          $topics[] = $outer_folder_name;
        }
        $series_list[] = $single_series;
      }
    }
    return [
      'series_list' => $series_list,
      'topics' => $topics,
    ]; 
  }
}
