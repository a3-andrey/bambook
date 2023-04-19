<div>
    <div wire:poll >
        <div class="col-md-4">
            <div class="box grid-box">
                <div class="box-header with-border">
                    Чаты
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover grid-table">
                        <thead>
                        <tr>
                            <th class="column-id">ID</th>
                            <th class="column-date_fill">ИМЯ</th>
                            <th class="column-hash">Почта</th>
                            <th class="column-hash">Новых сообщений</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr wire:click="selectUser({{ $item->id }})"
                                class="chat_content @if($user->id == $item->id) selected @endif">
                                <td class="column-id">
                                    {{ $item->id }}
                                </td>
                                <td class="column-hash">
                                    {{ $item->name }}
                                </td>
                                <td class="column-hash">
                                    {{ $item->email }}
                                </td>
                                <td id="message_count_{{ $item->id }}" class="column-hash">
                                    {{ $item->messages()->where('is_show',0)->count() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div  class="col-md-6">
            <div id="block_chat" class="support-chat">

                @foreach($user->messages?:[] as $msg)
                    <li class="support-chat__item @if($msg->guard == 'admin') support @endif">
                        <div class="support-chat__text-block">
                            <p class="support-chat__text">{{ $msg->message }}</p>
                            <div class="time">
                                <span >{{ \Carbon\Carbon::parse($msg->created_at)->format('d.m.Y H:i') }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach

            </div>
            <div class="message-field">
                <textarea wire:model.defer="message"  class="input-row__input basic-textarea"></textarea>
                <button wire:click="sendMessage" class="message-field__button"></button>

            </div>
            @error('message')<span class="error">{{ $message }}</span> @enderror
        </div>
    </div>
    <style>
        .time{
            float: right;
            width: 100%;
            text-align: end;
            margin-top: 5px;
            font-size: smaller;
        }
    </style>
</div>
