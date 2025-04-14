@extends('layouts.app')



@section('content')
<div class="grid grid-cols-6">
  <div class="col-span-5 col-start-2">
    <h1 class="text-lg font-semibold ml-4">Create Event</h1>
    <div class="flex items-center justify-center p-4 mt-3 w-full">
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden p-4">
         <form>
          @csrf
          <!-- Cancel and share buttons -->
          <div id="cancel-share-but" class="flex items-center justify-between p-2 hidden">
            <button id="cancel-button" type="reset" class="text-base font-medium text-gray-900 hover:text-gray-500">Cancel</button>
            <button type="submit" class=" hover:text-purple-950 text-purple-600 font-semibold rounded-full px-5 py-2 text-base">Share</button>
          </div>

          <!-- Image Preview Area -->
          <div id="imagePreview" class="hidden relative rounded-lg overflow-hidden bg-gray-100">
              <img id="previewImg" src="" alt="Preview" class="w-full object-cover">
              <button type="button" id="removeImage" class="absolute top-2 right-2 bg-gray-800 bg-opacity-70 rounded-full p-1 text-white hover:bg-gray-900">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
              </button>
          </div>

          <!-- Upload Image -->
          <div class="flex items-center border-t p-2">
              <div class="flex items-center space-x-2 mt-6 mb-2">
                  <label for="imageInput" class="flex items-center gap-2 cursor-pointer text-purple-500 hover:text-purple-700">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      <span class="text-sm">Upload</span>
                  </label>
                  <input type="file" id="imageInput" name="image" accept="image/*" class="hidden">
              </div>
          </div>

          <!-- Caption Input -->
          <div class="border">
              <textarea
                  cols="50" rows="18" 
                  name="caption" 
                  placeholder="Write your caption..." 
                  class="w-full resize-none border-0 focus:ring-1 focus:ring-purple-500 text-base text-gray-600 placeholder-gray-400 p-2 min-h-[120px]"
              >{{ old('caption') }}</textarea>
          </div>
         </form> 
        </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeImageBtn = document.getElementById('removeImage');
        const cancelShareBtn = document.getElementById('cancel-share-but');
        const cancelButton = document.getElementById('cancel-button');

        // Function to reset image previewImg
        const resetImagePreview = () => {
          imageInput.value = '';
          imagePreview.classList.add('hidden');
          cancelShareBtn.classList.add('hidden');
          previewImg.src = '';
        }
        
        // Handle image selection
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    cancelShareBtn.classList.remove('hidden');
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Remove image
        removeImageBtn.addEventListener('click', resetImagePreview);

        // Remove image using cancel button
        cancelButton.addEventListener('click', resetImagePreview);
    });
</script>
@endsection


</html>