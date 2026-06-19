@extends('layouts.admin')

@section('title', 'Homepage Heroes')
@section('page_title', 'Homepage Hero Management')

@section('admin_content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <p class="text-sm text-[#6B7280]">Manage the active homepage hero content, buttons, stats, image, and floating cards.</p>
    <a href="{{ url('/admin/homepage-heroes/create') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-xs font-bold uppercase tracking-wider rounded-full text-white bg-[#006F5C] hover:bg-[#005547] shadow-md hover:shadow-lg transition-all duration-200">
        Add Hero
    </a>
</div>

<div class="bg-white border border-[#EEF7F4] rounded-[24px] shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#F4FAF8] border-b border-[#EEF7F4] text-xs font-bold uppercase tracking-wider text-[#6B7280]">
                    <th class="px-6 py-4">Hero</th>
                    <th class="px-6 py-4">Buttons</th>
                    <th class="px-6 py-4">Stats</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm font-medium text-[#374151]">
                @forelse($heroes as $hero)
                    <tr class="border-b border-[#F4FAF8] hover:bg-[#F4FAF8]/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if($hero->hero_image)
                                    <img src="{{ asset($hero->hero_image) }}" alt="" class="h-16 w-24 object-cover rounded-xl border border-[#EEF7F4]">
                                @else
                                    <div class="h-16 w-24 rounded-xl bg-[#EEF7F4] border border-[#EEF7F4]"></div>
                                @endif
                                <div>
                                    <div class="font-bold text-[#111827]">{{ $hero->main_title }}</div>
                                    <div class="text-xs text-[#006F5C] font-bold mt-1">{{ $hero->badge_text }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-[#6B7280]">
                            <div>{{ $hero->primary_button_text }} -> {{ $hero->primary_button_link }}</div>
                            <div>{{ $hero->secondary_button_1_text }} -> {{ $hero->secondary_button_1_link }}</div>
                            @if($hero->secondary_button_2_text)
                                <div>{{ $hero->secondary_button_2_text }} -> {{ $hero->secondary_button_2_link }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-[#111827]">
                            {{ $hero->happy_patients_number }} / {{ $hero->services_number }} / {{ $hero->years_of_excellence_number }}
                        </td>
                        <td class="px-6 py-4">
                            @if($hero->status === 'active')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#EEF7F4] text-[#006F5C] border border-[#006F5C]/10">Active</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#FDF2F5] text-[#CC205C] border border-[#CC205C]/10">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ url('/admin/homepage-heroes/' . $hero->id . '/edit') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-[#EEF7F4] text-[#006F5C] hover:bg-[#006F5C] hover:text-white transition-colors text-xs font-bold">
                                Edit
                            </a>
                            <form action="{{ url('/admin/homepage-heroes/' . $hero->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this homepage hero?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-pink-50 text-[#CC205C] hover:bg-[#CC205C] hover:text-white transition-colors text-xs font-bold">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-[#6B7280]">
                            No homepage heroes exist. Create one to customize the homepage.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
