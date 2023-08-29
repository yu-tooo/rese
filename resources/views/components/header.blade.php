<div class="block sm:flex justify-between">
  <x-application-logo />
  @if(Request::routeIs('*.home'))
  <form action="{{ route(Route::currentRouteName()) }}" class="w-full">
    <div class="text-right">
      <div class="inline-block py-0.5 bg-white shadow-xl rounded-sm mr-8">
        <select name="sort" class="py-1.5 border-none focus:ring-0 text-sm">
          <option hidden value="">並び替え:評価高/低</option>
          <option value="random">ランダム</option>
          <option value="high">評価が高い順</option>
          <option value="low">評価が低い順</option>
        </select>
      </div>
      <div class="inline-block py-1 bg-white shadow-xl rounded-md">
        <select name="area" class="py-1.5 border-none focus:ring-0 text-sm">
          <option value="">All area</option>
          <option value="東京">東京</option>
          <option value="大阪">大阪</option>
          <option value="福岡">福岡</option>
        </select>
        <select name="genre" class="py-1.5 border-none focus:ring-0 text-sm">
          <option value="">All genre</option>
          <option value="寿司">寿司</option>
          <option value="焼肉">焼肉</option>
          <option value="居酒屋">居酒屋</option>
          <option value="イタリアン">イタリアン</option>
          <option value="ラーメン">ラーメン</option>
        </select>
        <x-icons.search />
        <input type="text" name="name" class="w-72 py-1 pl-2 pr-0 border-none focus:ring-0" placeholder="Search...">
      </div>
    </div>
  </form>
  @endif
</div>