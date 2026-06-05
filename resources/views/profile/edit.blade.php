<x-app-layout>
    <div class="mb-10">
        <h1 class="text-3xl font-bold tracking-tight text-piano">Profile settings</h1>
        <p class="text-piano/60 mt-1">Update your account information and professional details.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
        <div class="bg-pearl border border-piano/10 rounded-2xl p-8 shadow-sm">
            <h2 class="text-xl font-bold text-piano mb-6 pb-4 border-b border-piano/5">Account</h2>
            
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-sm font-bold text-piano mb-2">Display Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano outline-none text-piano" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-piano mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano outline-none text-piano" required>
                </div>

                @if($user->isWorker())
                    <div class="pt-6 mt-6 border-t border-piano/5">
                        <h3 class="text-sm font-bold text-piano/50 uppercase tracking-wider mb-4">Professional profile</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="phone" class="block text-sm font-bold text-piano mb-2">Phone (optional)</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->workerProfile?->phone) }}" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano outline-none text-piano">
                            </div>
                            
                            <div>
                                <label for="location" class="block text-sm font-bold text-piano mb-2">Location (optional)</label>
                                <input type="text" id="location" name="location" value="{{ old('location', $user->workerProfile?->location) }}" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano outline-none text-piano">
                            </div>

                            <div>
                                <label for="bio" class="block text-sm font-bold text-piano mb-2">Bio (optional)</label>
                                <textarea id="bio" name="bio" rows="4" class="w-full bg-[#F8F9FA] border border-piano/10 rounded-xl px-4 py-3 focus:ring-2 focus:ring-piano outline-none text-piano resize-none">{{ old('bio', $user->workerProfile?->bio) }}</textarea>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="btn-piano px-8">Save changes</button>
                </div>
            </form>
        </div>

        <div class="bg-failure/5 border border-failure/20 rounded-2xl p-8 shadow-sm h-fit">
            <h2 class="text-xl font-bold text-failure mb-2 pb-4 border-b border-failure/10">Delete account</h2>
            <p class="text-piano/60 text-sm mb-6 mt-4">This will permanently delete your account and remove your data. This action cannot be undone.</p>
            
            <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Delete your account permanently?');" class="space-y-6">
                @csrf
                @method('delete')
                <div>
                    <label for="password" class="block text-sm font-bold text-piano mb-2">Authorization Code (Password)</label>
                    <input type="password" id="password" name="password" placeholder="Confirm your password" class="w-full bg-pearl border border-failure/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-failure outline-none text-piano" required>
                </div>
                <button type="submit" class="bg-failure text-pearl font-bold py-3 px-6 rounded-xl hover:bg-failure/80 transition-colors w-full">Delete account</button>
            </form>
        </div>
    </div>
</x-app-layout>