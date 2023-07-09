<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-2xl text-neutral-800 leading-tight">
        {{ __('Messages') }}
      </h2>
    </x-slot>
  
    <div id="chatApp">
      <select id="userSelect"></select>
      <ul id="messageList"></ul>
      <input type="text" id="newMessage" placeholder="Type a message...">
      <button id="sendMessage">Send</button>
    </div>
  
</x-app-layout>
  