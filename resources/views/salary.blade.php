@extends('admin')

@section('content')
<div class="container mt-5">
    <h2>Salaries</h2> <br>
    <table class="table">
        <thead>
            <tr>
            @if(isset($permissions['basic_salary']) && $permissions['basic_salary'][1] == '1')
            <th>Basic Salary</th>
            @endif
            @if(isset($permissions['allowance']) && $permissions['allowance'][1] == '1')
                <th>Allowance</th>
            @endif
            @if(isset($permissions['social_insurance']) && $permissions['social_insurance'][1] == '1')
                <th>Social Insurance</th>
            @endif
            @if(isset($permissions['health_insurance']) && $permissions['health_insurance'][1] == '1')
                <th>Health Insurance</th>
            @endif
            @if(isset($permissions['unemployment_insurance']) && $permissions['unemployment_insurance'][1] == '1')
                <th>Unemployment Insurance</th>
            @endif
            @if(isset($permissions['personal_income_tax']) && $permissions['personal_income_tax'][1] == '1')
                <th>Personal Income Tax</th>
            @endif
            @if(isset($permissions['total_salary']) && $permissions['total_salary'][1] == '1')
                <th>Total Salary</th>
            @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($salaries as $salary)
                <tr>
                    @if(isset($permissions['basic_salary']) && $permissions['basic_salary'][1] == '1')
                        <td>{{ $salary->basic_salary }}</td>
                    @endif
                    @if(isset($permissions['allowance']) && $permissions['allowance'][1] == '1')
                        <td>{{ $salary->allowance }}</td>
                    @endif
                    @if(isset($permissions['social_insurance']) && $permissions['social_insurance'][1] == '1')
                        <td>{{ $salary->social_insurance }}</td>
                    @endif
                    @if(isset($permissions['health_insurance']) && $permissions['health_insurance'][1] == '1')
                        <td>{{ $salary->health_insurance }}</td>
                    @endif
                    @if(isset($permissions['unemployment_insurance']) && $permissions['unemployment_insurance'][1] == '1')
                        <td>{{ $salary->unemployment_insurance }}</td>
                    @endif
                    @if(isset($permissions['personal_income_tax']) && $permissions['personal_income_tax'][1] == '1')
                        <td>{{ $salary->personal_income_tax }}</td>
                    @endif
                    @if(isset($permissions['total_salary']) && $permissions['total_salary'][1] == '1')
                        <td>{{ $salary->total_salary }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
