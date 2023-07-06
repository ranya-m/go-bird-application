<input x-ref="datepicker"
       type="date"
       :name="$attributes['name'] ?? ''"
       :id="$attributes['id'] ?? ''"
       :disabled="disableDatepickerDate($el.value)">
