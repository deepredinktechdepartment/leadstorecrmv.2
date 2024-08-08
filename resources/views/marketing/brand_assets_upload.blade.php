




  <div class="row">
    <div class="col-lg-6">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card h-100">
            <div
          class="d-flex justify-content-between align-items-center"
        >
          <h4>Brand Guidelines</h4>
          <div class="action_icons gap-3 d-flex">

              <!--<a class="hover-underline" href=""><i class="fa-solid fa-plus"></i></a>-->
          </div>
        </div>

        <ul class="list-unstyled">
            <li>
              <a class="hover-underline" href="{{ route('brandassets.colors.view',['type_of_upload'=>'brand_colors','action_type'=>'show']) }}">Brand colors</a>
            </li>
            <li>
              <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(10)) }}" class="hover-underline">Brand fonts</a>
            </li>
            <li>
              <!--<a class="hover-underline" href="{{ url('documents-create?documenttype=7') }}" class="hover-underline">Brand Manual</a>-->
              <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(7)) }}" class="hover-underline">Brand Manual</a>
            </li>
          </ul>

          </div>





        </div>

        <div class="col-lg-12">
          <div class="project_scope mb-4">
            <div class="card h-100">

              <div
          class="d-flex justify-content-between align-items-center"
        >
          <h4>Offline Branding Collaterals</h4>
          <div class="action_icons gap-3 d-flex">

              <!--<a class="hover-underline" href="#"><i class="fa-solid fa-plus"></i></a>-->
          </div>
        </div>
              <ul class="list-unstyled">
                <li>
                  <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(11)) }}">Stall Designs</a>
                </li>
                <li>
                  <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(12)) }}">Median Ads</a>
                </li>
                <li>
                  <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(13)) }}">Newspaper Ads</a>
                </li>
                <li>
                  <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(14)) }}">Event Collaterals</a>
                </li>
                <li>
                  <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(15)) }}">News Coverage</a>
                </li>
                <li>
                  <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(16)) }}">Radio Ads</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-lg-6">
      <div class="project_scope">
        <div class="card h-100">

          <div
          class="d-flex justify-content-between align-items-center"
        >
          <h4>Brochures, Flyers & Pitch Decks</h4>
          <div class="action_icons gap-3 d-flex">

              <!--<a class="hover-underline" href=""><i class="fa-solid fa-plus"></i></a>-->
          </div>
        </div>
          <ul class="list-unstyled">
            <li>
              <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(8)) }}">Small Brochure</a>
            </li>
            <li>
              <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(9)) }}">Full Brochure</a>
            </li>
            <li>
              <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(17)) }}">Corporate Presentation</a>
            </li>
            <li>
              <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(18)) }}">Walk through Video</a>
            </li>
            <li>
              <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(19)) }}">Drone Video</a>
            </li>
            <li>
              <a class="hover-underline" href="{{ url('documents/documenttype/'.Crypt::encryptString(20)) }}">Construction updates</a>
            </li>
          </ul>
        </div>
      </div>


      <div class="col-lg-6 mt-4">
        <div class="project_scope">
          <div class="card h-100">

            <div
            class="d-flex justify-content-between align-items-center"
          >
            <h4>Digital Assets</h4>
            <div class="action_icons gap-3 d-flex">

                <!--<a class="hover-underline" href=""><i class="fa-solid fa-plus"></i></a>-->
            </div>
          </div>
            <ul class="list-unstyled">
              <li>
                @if (empty($checklist['socialmedia_handles']))
                <a class="hover-underline" href="{{ route('socialmedia_handle.create',['type_of_upload'=>'socialmedia_handle','action_type'=>'upload']) }}">Social Media Handles</a>
                @else
                <a class="hover-underline" href="{{ route('socialmedia_handle.views',['type_of_upload'=>'socialmedia_handle','action_type'=>'show']) }}">Social Media Handles</a>

                @endif
              </li>
              <li>
                @if (empty($checklist['website_cms_cred']))
                <a class="hover-underline" href="{{ route('website_cms.create',['type_of_upload'=>'website_cms_cred','action_type'=>'upload']) }}">Website</a>
                @else
                <a class="hover-underline" href="{{ route('website_cms.views',['type_of_upload'=>'website_cms_cred','action_type'=>'show']) }}">Website</a>
                @endif
              </li>

            </ul>
          </div>
        </div>
      </div>


    </div>






  </div>


  {{-- Image gallery --}}

<!--
  <div class="row">
    <div class="col-lg-12">
      <div class="mb-4">
        <div class="card">
          <div
          class="d-flex justify-content-between align-items-center"
        >
          <h4>Photo Gallery</h4>
          <div class="action_icons gap-3 d-flex">

              <a class="hover-underline" href=""><i class="fa-solid fa-plus"></i></a>
          </div>
        </div>
          <p class="mb-4">
            <small>Uploaded by Admin. Oct 2020</small>
          </p>
          <div class="row mb-lg-4">
            <div class="col-lg-8">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="245px"
              />
            </div>
            <div class="col-lg-4">
              <div class="row mb-lg-4">
                <div class="col-lg-6">
                  <img
                    src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                    alt=""
                    width="100%"
                    height="110px"
                  />
                </div>
                <div class="col-lg-6">
                  <img
                    src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                    alt=""
                    width="100%"
                    height="110px"
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <img
                    src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                    alt=""
                    width="100%"
                    height="110px"
                  />
                </div>
                <div class="col-lg-6">
                  <img
                    src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                    alt=""
                    width="100%"
                    height="110px"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="mb-4">
        <div class="card">
          <div
          class="d-flex justify-content-between align-items-center"
        >
          <h4>Video Gallery</h4>
          <div class="action_icons gap-3 d-flex">

              <a class="hover-underline" href=""><i class="fa-solid fa-plus"></i></a>
          </div>
        </div>
          <p class="mb-4">
            <small>Uploaded by Admin. Oct 2020</small>
          </p>
          <div class="row mb-lg-4">
            <div class="col-lg-8">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="245px"
              />
            </div>
            <div class="col-lg-4">
              <div class="row mb-lg-4">
                <div class="col-lg-6">
                  <img
                    src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                    alt=""
                    width="100%"
                    height="110px"
                  />
                </div>
                <div class="col-lg-6">
                  <img
                    src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                    alt=""
                    width="100%"
                    height="110px"
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <img
                    src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                    alt=""
                    width="100%"
                    height="110px"
                  />
                </div>
                <div class="col-lg-6">
                  <img
                    src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                    alt=""
                    width="100%"
                    height="110px"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
            <div class="col-lg-2">
              <img
                src="{{URL::to('assets/img/blogs/blog_img1.jpg')}}"
                alt=""
                width="100%"
                height="110px"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

-->