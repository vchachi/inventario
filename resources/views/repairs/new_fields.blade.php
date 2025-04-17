@push('page_css')
        <link rel="stylesheet" href="{{asset('css/repair-add.css')}}">
@endpush
<div class="whole-body">
    <div class="nav-bar">
        <h5 class="title">Pending payment acceptence  <arrow class="arrow">🢗</arrow> </h5>

        <div class="buttons">
            <div class="sign">
                <button type="button" class="sign-button yellow"><div class="sign-btn"><img src="{{asset('images/repairs-images/signin.svg')}}" alt="signIn">Sign</div></button>
            </div>
            <div class="change-status">
            <button type="button" class="sign-button green"><div class="sign-btn"><img src="{{asset('images/repairs-images/status.svg')}}" alt="status">Change Status</div></button>
            </div>
        </div>
    </div>
    <form class="form">
        <div class="form-body">
        <!-- 1 -->
            <div class="input-container">
                <p class="category"><label for="categories">Categories</label></p>
                <select name="categories" id="categories" class="categories">
                    <option value="smartphone">Smart Phone</option>
                    <option value="computer">Computer</option>
                    <option value="tablet">Tablet</option>
                    <option value="tickets">Tickets</option>
                    <option value="services">Services</option>

                </select>
            </div> 
        <!-- 2 -->
            <div class="input-container">
                <p class="category"><label for="model">Model</label></p>
                <select name="categories" id="model" class="categories">
                    <option value="samsung">Samsung</option>
                    <option value="apple">Apple</option>
                    <option value="asus">Asus</option>
                    <option value="oppo">Oppo</option>
                    <option value="sony">Sony</option>

                </select>
            </div>
        <!-- 3 -->
            <div class="input-container">
                <p class="category"><label for="templetes">Templete (optional)</label></p>
                <select name="templetes" id="templetes" class="categories">
                    <option value="smartphone">Iphone 13 pro max</option>
                    <option value="computer">Samsung Galaxy 22 Ulta</option>
                    <option value="tablet">Iphone 12</option>
                    <option value="tickets">Iphone 11</option>
                    <option value="services">Iphone X</option>
                </select>
            </div>
        <!-- 4 -->
            <div class="input-container">
                <p class="category"><label for="imei">IMEI/SN (optional)</label></p>
                <input type="number" placeholder="00000000000" class="categories">
            </div>
        <!-- 5 -->
            <div class="input-container">
                <p class="category"><label for="templetes">Repair Cost (optional)</label></p>
                <input type="number" placeholder="100000$" class="categories">
            </div>
        <!-- 6 -->
            <div class="input-container">
                <div class="concepts">
                    <p class="category"><label for="concepts">Concepts (max 3)</label></p>
                    <p class="category text-right"> Cutomized</p>
                </div>
                <select name="categories" id="concepts" class="categories">
                    <option value="speaker">Speaker</option>
                    <option value="microphone">Microphone</option>
                    <option value="">Option 3</option>
                    <option value="">Option 4</option>
                    <option value="">Option 5</option>
                </select>
            </div>
        </div>
        <!-- 7 -->
        <div class="text-area-container">
            <p class="category"><label for="concepts" id="usrform">Observations</label></p>
            <textarea rows="4" cols="40" name="comment" class="text-area" form="usrform"></textarea>
        </div>
        <!-- <div>
            <button type="button" class="btn btn-dark">Submit</button>
        </div> -->
    </form>
</div>