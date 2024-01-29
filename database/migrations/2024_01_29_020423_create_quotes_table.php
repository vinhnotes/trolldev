<?php

use App\Models\Quote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->string('author')->nullable();
            $table->string('reference')->nullable();
            $table->timestamps();
        });

        $data =  array(
            [
                'content'  => "Dont't worry if it doesn't work right. If everything did, you'd be out of a job.",
                'author'  =>  '',
            ],
            [
                'content'  => "Don't comment bad code - rewrite it.",
                'author'  =>  'Brian Kernighan',
            ],
            [
                'content'  => "A programming language is for thinking about programs, not for expressing programs you've already thought of. It should be a pencil, not a pen. ",
                'author'  =>  'Paul Graham',
            ],
            [
                'content'  => "Sometimes it pays to stay in bed on Monday, rather than spending the rest of the week debugging Monday's code.",
                'author'  =>  'Dan Salomon',
            ],
            [
                'content'  => "It's better to wait for a productive programmer to become available than it is to wait for the first available programmer to become productive.",
                'author'  =>  'Steve McConnell',
            ],
            [
                'content'  => "One of my most productive days was throwing away 1000 lines of code.",
                'author'  =>  'Ken Thompson',
            ],
            [
                'content'  => "Without requirements or design, programming is the art of adding bugs to an empty text file.",
                'author'  =>  '',
            ],
            [
                'content'  => "One main'scrappy software is another man's full time job.",
                'author'  =>  '',
            ],
            [
                'content'  => "Walking on water and developing software from a specification are easy if both are frozen.",
                'author'  =>  '',
            ],
            [
                'content'  => "Debugging is twice as hard as writing the code in the first place.Therfore, if you write the code as cleverly as possible, you are, by definition, not smart enough to debug it. ",
                'author'  =>  'Rajanand',
            ],
            [
                'content'  => "System programmers are the high priests of a low cult. ",
                'author'  =>  'Robert S. Barton',
            ],
            [
                'content'  => "I don't care if it works on your machine! We are not shipping your machine!",
                'author'  =>  'Vidiu Platon',
            ],
            [
                'content'  => "Software undergoes beta testing shortly before iy' released.Beta is latin for \"still doesn't work\"",
                'author'  =>  '',
            ],
            [
                'content'  => "Measuring programming progree by lines of code is like measuring aircraft building progree by weight. ",
                'author'  =>  'Bill Gates',
            ],
            [
                'content'  => "If debugging is the process of removing software bugs, then programming must be the process of putting them in. ",
                'author'  =>  'Edsger W. Dijkstra',
            ],
            [
                'content'  => "The computer was born to solve problems that did not exist before. ",
                'author'  =>  'Bill Gates',
            ],
            [
                'content'  => "Real programmers don't comment their code. If it was hard to write, it should be hard to understand.",
                'author'  =>  '',
            ],
            [
                'content'  => "Always code as if the guy who ends up maintaning your code will be a violent psychopath who knows where you live.",
                'author'  =>  'Rick Osborne',
            ],
            [
                'content'  => "People don't care about what you say, they care about what you build. ",
                'author'  =>  'Mark Zuckerberg',
            ],
            [
                'content'  => "We have to stop optimizing for programmers and start optimizing for users.",
                'author'  =>  'Jeff Atwood',
            ],
            [
                'content'  => "If the code and the comments do not match, possibly both are incorrect.",
                'author'  =>  'Norm Schryer',
            ],
            [
                'content'  => "Bad programmers worry about the code. Good programmers worry about data structures and their relationships.",
                'author'  =>  'Linus Torvalds',
            ],
            [
                'content'  => "If you optimize everything, you will always be unhappy.",
                'author'  =>  'Donald Knuth',
            ],
            [
                'content'  => "Your mind is programmable - if you're not programming your mind, else will program it for you.",
                'author'  =>  'Jeremy Hammond',
            ],
            [
                'content'  => "The trouble with programmers is that you can never tell what a programmer is doing until it's too late.",
                'author'  =>  'Seymour Cray',
            ],
            [
                'content'  => "Debugging becomes significantly easier if you first admit that you are the problem.",
                'author'  =>  'William Laeder',
            ],
            [
                'content'  => "Talk is cheap. Show me the code.",
                'author'  =>  'Linus Torvalds',
            ],
            [
                'content'  => "Everybody in this country should learn to program a computer because it teaches you how to think.",
                'author'  =>  'Steve Jobs',
            ],
            [
                'content'  => "Most good programmers do programming not because they expect to get paid or get adulation by the public, but because it is fun to program.",
                'author'  =>  'Rajanand',
            ],
            [
                'content'  => "Any fool can write code that a computer can understand. Good programmers write code that humans can understand.",
                'author'  =>  'Martin Fowler',
            ],
            [
                'content'  => "First, solve the problem. Then write the code. ",
                'author'  =>  'John Johnson',
            ],
            [
                'content'  => "The function of a good software is to make the complex appear to be simple.",
                'author'  =>  'Grady Booch',
            ],
            [
                'content'  => "Your most unhappy customers are your greatest source of learning.",
                'author'  =>  'Bill Gates',
            ],
            [
                'content'  => "Small minds are concerned with the extraordinary, great minds with the ordinary. ",
                'author'  =>  'Blaise Pascal',
            ],
            [
                'content'  => "Everyday life is like programming, I guess.If you love something you can put beauty on it.",
                'author'  =>  'Donald Knuth',
            ],
            [
                'content'  => "You are not responsible for the programming you picked up in childhood.However, as an adult, you are the one hundred percent responsible for fixing it.",
                'author'  =>  '',
            ],
            [
                'content'  => "Developer is an organism that turns coffee into code.",
                'author'  =>  '',
            ],
            [
                'content'  => "The purpose of software engineering is to control complexity, not to create it.",
                'author'  =>  '',
            ],
            [
                'content'  => "As a programmer, it is your job to put yourself out of business. What you do today can be automated tomorrow. ",
                'author'  =>  'Doug McIlroy',
            ],
            [
                'content'  => "A good programmer is someone who always looks both ways before crossing a one-way street.",
                'author'  =>  'Doug Linder',
            ],
            [
                'content'  => "Testing can only prove the presence of bugs, not their absence.",
                'author'  =>  'Edsger W. Dijkstra',
            ],
            [
                'content'  => "Experience is the name everyone gives to their mistakes.",
                'author'  =>  'Oscar Wilde',
            ],
            [
                'content'  => "Code is like humor. When you have to explain it, it's bad.",
                'author'  =>  'Cory House',
            ],
            [
                'content'  => "Fix the cause, not the symptom.",
                'author'  =>  'Steve Maguire',
            ],
            [
                'content'  => "Before software can be reusable it first has to be usable.",
                'author'  =>  'Ralph Johnson',
            ],
            [
                'content'  => "Make it work, make it right, make it fast.",
                'author'  =>  'Kent Beck',
            ],
            [
                'content'  => "There is a big difference between making a simple product & making a product simple.",
                'author'  =>  'Des Traynor',
            ],
            [
                'content'  => "In programming, the hard part isn't solving problems, but deciding what problems to solve.",
                'author'  =>  'Paul Graham',
            ],
            [
                'content'  => "No one in the brief history of computing has ever written a piece of perfect software. It's unlikely that you'll be the first.",
                'author'  =>  'Andy Hunt',
            ],
            [
                'content'  => "Give someone a program, you frustrate them for a day; teach them how to program, you frustrate them for a lifetime.",
                'author'  =>  'David Leinweber',
            ],
            [
                'content'  => "If the code doesn't bother you, don't bother it.",
                'author'  =>  '',
            ],
            [
                'content'  => "Software is like sex: it's better when it's free.",
                'author'  =>  'Linus Torvalds',
            ],
            [
                'content'  => "If we want users to like our software, we should design it to behave like a likable person.",
                'author'  =>  'Alan Cooper',
            ],
            [
                'content'  => "Quality is a product of a conflict between programmers and testers.",
                'author'  =>  'Yegor Bugayenk',
            ],
            [
                'content'  => "Everybody should learn to program a computer because it teaches you how to think.",
                'author'  =>  'Steve Jobs',
            ],
            [
                'content'  => "I taught myself how to program computers when I was a kid, bought my first computer when I was 10, and sold my first commercial program when I was 12.",
                'author'  =>  'Elon Musk',
            ],
            [
                'content'  => "Software and cathedrals are much the same — first we build them, then we pray.",
                'author'  =>  '',
            ],
            [
                'content'  => "Web development is difficult, only then it is fun to do. You just have to set your standards. If it were to be easy, would anyone do it?",
                'author'  =>  'Olawale Daniel',
            ],
            [
                'content'  => "Software comes from heaven when you have good hardware.",
                'author'  =>  'Ken Olsen',
            ],
            [
                'content'  => "There is always one more bug to fix.",
                'author'  =>  'Ellen Ullman',
            ],
            [
                'content'  => "If debugging is the process of removing bugs, then programming must be the process of putting them in.",
                'author'  =>  'Sam Redwine',
            ],
            [
                'content'  => "Sometimes it pays to stay in bed on Monday, rather than spending the rest of the week debugging Monday's code.",
                'author'  =>  'Dan Salomon',
            ],
            [
                'content'  => "If, at first, you do not succeed, call it version 1.0.",
                'author'  =>  'Khayri R.R. Woulfe',
            ],
            [
                'content'  => "Computers are fast; developers keep them slow.",
                'author'  =>  'Anonymous',
            ],
            [
                'content'  => "Programmer: A machine that turns coffee into code.",
                'author'  =>  'Anonymous',
            ],
            [
                'content'  => "Programmers seem to be changing the world. It would be a relief, for them and for all of us, if they knew something about it.",
                'author'  =>  'Ellen Ullman',
            ],
            [
                'content'  => "When I wrote this code, only God and I understood what I did. Now only God knows.",
                'author'  =>  'Anonymous',
            ],
            [
                'content'  => "Confusion is part of programming.",
                'author'  =>  'Felienne Hermans',
            ],
            [
                'content'  => "It's not a bug; it's an undocumented feature.",
                'author'  =>  'Anonymous',
            ],
            [
                'content'  => "Coding like poetry should be short and concise.",
                'author'  =>  'Santosh Kalwar',
            ],
            [
                'content'  => "Programming is the art of algorithm design and the craft of debugging errant code.",
                'author'  =>  'Ellen Ullman',
            ],
            [
                'content'  => "Clean code always looks like it was written by someone who cares.",
                'author'  =>  'Robert C. Martin',
            ],
        );

        foreach ($data as $datum) {
            $category = new Quote();
            $category->content = $datum['content'];
            $category->author = $datum['author'];
            $category->save();
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
