<?php

namespace Botble\Location\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class LocationImportRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'import_type' => 'required|in:country,state,city',
            'order' => 'nullable|integer|min:0|max:127',
            'abbreviation' => 'integer|max:2',
            'status' => 'string|required|' . Rule::in(BaseStatusEnum::values()),
            'country' => 'string|required_if:import_type,state,city',
            'state' => 'string|required_if:import_type,city',
            'nationality' => 'string|required_if:import_type,country|max:120',
        ];
    }

    public function messages(): array
    {
        return [
            'country.required_if' => trans('plugins/location::bulk-import.import_type_required_if'),
            'nationality.required_if' => trans('plugins/location::bulk-import.import_type_required_if'),
            'state.required_if' => trans('plugins/location::bulk-import.import_type_required_if'),
        ];
    }
}
