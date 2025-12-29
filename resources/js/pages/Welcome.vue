<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
	<Head title="Welcome">
	</Head>
	<!-- Header - Should have buttons to dashboard, eventually blog and update log -->
	<div class="bg-[#363636] text-[#f5f5f5]">
		<header class="pb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
			<nav class="flex justify-start gap-4 object-top-left place-content-start flex-1 p-4">
				<Link
					:href="route('dashboard')"
					class="inline-block rounded-sm border border-[#f5f5f5] px-5 py-1.5 text-sm leading-normal text-[#f5f5f5] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
				>
					App Dashboard
				</Link>
			</nav>
			<p class="text-2xl font-bold pl-4 pt-4">
				Welcome to Randy's Website
			</p>
		</header>	
	</div>
	<!-- Main body - About me and about this website -->
	<body>
		<!-- Picture of me with brief intro -->
		<div class="flex columns-2 gap-8 bg-[#363636] pb-12 text-[#f5f5f5] bg-gradient-to-b from-[#363636] to-white pr-4">
			<div class="pl-4">
				<img 
					src="https://i.imgur.com/b3KPksF.png"
					alt="Randy with a cow"
					class="pb-4"
					/>
				<p class="italic text-[#363636]">This is me with an Italian cow in July 2025.</p>
			</div>
			<div>
				<p class="pt-4">
					I'm Randy Caldwell, a software developer based in Silver Spring, MD.
				</p>
				<p class="pt-4">
					This is where I post projects, thoughts, and updates. 
				</p>
			</div>	
		</div>
		<!-- About me section with links to other profiles -->
		<div class="pl-4 pr-4 pb-16">
			<p class="text-2xl font-bold pt-4">
				About Me
			</p>
			<p class="pt-4">
				I have about 15 years total in various IT roles, most recently as a full stack developer building
				safety software for private flight departments. In that role, I led the development of several API integrations.
				Prior to that, I worked as a help desk agent, incident manager, and finally senior system administrator.
			</p>
			<p class="pt-4 pb-4">
				I'm the father of three amazing sons. My hobbies include climbing, writing, hiking, kayaking, and science fiction.
			</p>
			<div class="pl-4 pt-4 pb-4 font-mono rounded-sm border border-[#19140035] underline underline-offset-4 w-64">
				<nav>
					<ul class="list-disc pl-4">
						<li>
							<a href="https://github.com/goat-therandy">
								Github Profile
							</a>
						</li>
						<li>
							<a href="https://www.linkedin.com/in/randy-caldwell-arc/">
								LinkedIn Profile
							</a>
						</li>
					</ul>
				</nav>
			</div>
			<!-- About this website section with links to projects -->
			<p class="text-2xl font-bold pt-4">
				About This Website
			</p>
			<p class="pt-4 pb-4">
				This is where I work on projects that I think can showcase my skills as a developer.
				<strong>The site is currently under construction</strong>, but feel free to poke around in the meantime.
				If you'd like to check out my current projects, please click the <strong>App Dashboard</strong> link in the top left.
				Or you can skip directly to the apps by clicking one of the links below:
			</p>
			<div class="pl-4 pt-4 pb-4 font-mono rounded-sm border border-[#19140035] underline underline-offset-4 w-64">
				<nav>
					<ul class="list-disc pl-4">
						<li>
							<Link 
							:href="route('weather')"
							>
							Simple Weather
							</Link>
						</li>
						<li>
							<Link
							:href="route('chatbot')"
							>
							Simple Chatbot
							</Link>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</body>
</template>