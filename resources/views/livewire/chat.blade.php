<div>
    <div class="msger " id="messages">
        <style>
            #scrollToBottomBtn {
                position: fixed;
                bottom: 30px;
                right: 30px;
                z-index: 1000;
                background-color: #005d5d;
                color: white;
                border: none;
                padding: 12px 16px;
                border-radius: 50%;
                font-size: 20px;
                cursor: pointer;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                transition: background-color 0.3s ease;
            }

            #scrollToBottomBtn:hover {
                background-color: #008c8c;
            }
            .preview-img-wrapper {
                display: inline-block;
                position: absolute;
                margin-bottom: 10px;
                bottom:-10px;
            }
            
            .preview-img-wrapper img {
                max-height: 150px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }
            
            .preview-img-wrapper p {
                position: absolute;
                top: -10px;
                right: -10px;
                background-color: red;
                color: white;
                border: none;
                border-radius: 50%;
                font-size: 18px;
                cursor: pointer;
                    padding: 8px 12px;
            }
            #modalImage {
        transition: all 0.3s ease;
    }
        </style>
        <div class="msger-chat" wire:poll.300s>

            {{-- <h3 wire:click="loadMoreMessages()" style="text-align: center">Load Earlier message</h3> --}}
            @if ($messages)
                @foreach ($messages as $key => $datas)
                    <p class="text-center p-2">{{ $key }}</p>
                    @foreach ($datas as $msg)
                        @php
                        if($msg->profile_image){
                         $user_image = asset('storage/'.$msg->profile_image);
                        }else{
                            $user_image =
                                isset($msg->user->image) &&
                                preg_match('/^data:image\/(\w+);base64,/', @$msg->user->image)
                                    ? @$msg->user->image
                                    : asset(@$msg->user->image ?? 'images/avatar.png')  ;
                        }
                            
                        @endphp

                        @if (auth()->user()->id === $msg->user_id)
                            <div class="msg right-msg">
                                <div class="msg-img" style="background-image: url({{ $user_image }})">
                                </div>

                                <div class="msg-bubble">
                                    <div class="msg-text">
                                        {{ $msg->body }}
                                    </div>
                                    @if ($msg->file)
                                        <img src="{{ asset('storage/'.$msg->file) }}" alt="Image" style="  border-radius: 5px;" onclick="openModal('{{ asset('storage/'.$msg->file) }}')">
                                    @endif
                                    <div class="msg-info">
                                        <div class="msg-info-name">{{ $msg->user->name ?? $msg->user_name }}</div>

                                        <div class="msg-info-time">
                                            {{ \Illuminate\Support\Carbon::parse($msg->created_at)->format('h:i A') }}
                                        </div>


                                    </div>
                                    @if(auth()->user()->role == 'super admin') <span style="background:red;padding: 2px 5px;color:#fff"  wire:click="deletemsg({{$msg->id}})">Delete</span> @endif
                                </div>
                            </div>
                        @else
                            <div class="msg left-msg">
                                <div class="msg-img" style="background-image: url({{ $user_image }})">
                                </div>

                                <div class="msg-bubble">
                                    <div class="msg-text">
                                        {{ $msg->body }}
                                    </div>
                                    @if ($msg->file)
                                        <img src="{{ asset('storage/'.$msg->file) }}" alt="Image" style="  border-radius: 5px;" onclick="openModal('{{ asset('storage/'.$msg->file) }}')">
                                    @endif
                                    <div class="msg-info">
                                        <div class="msg-info-name">{{ $msg->user->name ?? $msg->user_name }}</div>

                                        <div class="msg-info-time">
                                            {{ \Illuminate\Support\Carbon::parse($msg->created_at)->format('H:i A') }}
                                        </div>
                                    @if(auth()->user()->role == 'super admin') <span style="background:red;padding: 2px 5px;color:#fff" wire:click="deletemsg({{$msg->id}})">Delete</span> @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            @endif


        </div>

    </div>
     @if ($image)
            <div class="preview-img-wrapper">
                <img src="{{ $image->temporaryUrl() }}" alt="Preview">
                <p wire:click="removeImage">X</p>
            </div>
        @endif
    <div class="chat">
       
       
        <form wire:submit.prevent="sendMessage">
            <div class="container" style="max-width:100%;justify-content:center">

                @if (auth()->user()->role == 'super admin')
                     <div style="width: 15%">
                        <input type="file" class="form-control" wire:model="profileImage" style="
                    padding: 7px;
                    border: 1px solid #ededed;
                    border-radius: 1px;
                ">      
                    </div>
                    <div style="width: 15%">
                        <input type="text" class="form-control" placeholder="আপনার নাম লিখুন" wire:model="user_name" style="
                    padding: 7px;
                    border: 1px solid #ededed;
                    border-radius: 1px;
                ">      
                    </div>
                @endif

                <div style="@if (auth()->user()->role == 'super admin') width: 40% @else width: 70% @endif">
                    <input class="form-control" type="text" placeholder="আপনার মেসেজ লিখুন" wire:model="message"
                        style="
                    padding: 7px;
                    border: 1px solid #ededed;
                    border-radius: 1px;
                ">
                </div>
                <div style="width: 15%">

                    <label for="file-upload" style="cursor: pointer;margin-tp: 0px;">
                        <img style="
                    width: 28px;
                    height: 30px;
                    border-radius: 0px;
                    display:block;
                    margin-left: 10px;
                "
                            src="https://cdn-icons-png.freepik.com/256/1296/1296698.png?semt=ais_hybrid" />
                    </label>
                    <input id="file-upload" type="file" class="form-control" wire:model="image"
                        >
                </div>

                <div style="width: 15%">
                    <button name="submit"
                        style="
                    padding: 0px;
                    border: none;
                "
                        type="submit">
                        <img style="
                        height: 30px;
                        border-radius: 0px;
                        width: 30px;
                      "
                            src="https://cdn-icons-png.flaticon.com/256/10924/10924424.png" />
                    </button>
                </div>
            </div>
        </form>
    </div>
    
     <div id="imageModal" class="modal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow:auto; background:rgba(0,0,0,0.8);">
        <span onclick="closeModal()" style="position:absolute;top:20px;right:35px;color:#fff;font-size:40px;font-weight:bold;cursor:pointer;">&times;</span>
        <img id="modalImage" style="margin:auto;display:block;max-width:90%;max-height:80%;">
    </div>
    
   

</div>

@push('scripts')
   
@endpush
