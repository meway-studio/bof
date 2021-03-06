<?php
Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_PAGE_ABOUT' ), 'keywords' );
Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_PAGE_ABOUT' ), 'description' );
$this->pageTitle = 'About BOF';
?>
<div class="about-slide"></div>
<div id="q1"></div>
<?php //Yii::app()->user->id; ?>
<div class="site-width">
    <div class="about-us">
        <div class="about-left">
            <div class="title">
                <?php echo Yii::t( 'themes', '<span class="bold">О</span> <span>БОФ</span> ' ); ?>
            </div>
            <div class="about-menu">
                <a href="#q1"><?php echo Yii::t( 'themes', 'Наша команда' ); ?></a> <a href="#q2"><?php echo Yii::t(
                        'themes',
                        'История БОФ'
                    ); ?></a>
                <?php echo CHtml::link( Yii::t( 'themes', 'Стать партнером' ), array( '/guidline/default/contacts' ) ); ?>
            </div>
			<span class="blue-text"><?php echo Yii::t('themes', 'Ничего<br>больше<br><span>просто<br>ставки<br>на футбол</span>'); ?></span>
        </div>
        <div id="q1" class="questions">
            <div class="question">
                <span class="q-name"><?php echo Yii::t( 'themes', 'Кто мы?' ); ?></span>
                <span class="q-caps">Мы команда профессионалов, которые любят футбол также, как и Вы!
                    <br/>
                </span>
                <span id="q2" class="q-little">Мы болеем не только за любимые команды, но также получаем дикое

удовольствие от красоты владения мячом, тактики, соперничества и духа в 

матчах с участием других команд – также, как и Вы!</span>
                <span class="q-little">
                    Существует истина, которая гласит, что если на жизнь мы зарабатываем 

тем, что нам нравится, то мы можем считать себя счастливыми. Команда 

BetonFootball может назвать себя поистине счастливой из-за того, что мы не 

просто любим наше дело, мы живем им, обсуждаем с друзьями и каждый раз с 

нетерпением ждем нового спортивного события, также, как и Вы!
                </span>
            </div>
            <div class="question">
                <span class="q-name"><?php echo Yii::t( 'themes', 'Для чего?' ); ?></span>
                <span class="q-caps">
                    Мы уверены в том, что футбол - это не просто игра, это целая наука. А чтобы

совершать научные прорывы и наслаждаться благами цивилизации необходимо 

постоянно анализировать данные, получать информацию и выстраивать 

результат в логические цепочки.
                </span>
                <span class="q-little">
                    Подобно докторам, которые для постановки диагноза изучают историю

жизни пациента, историю болезни, назначают все необходимые исследования 

и анализы, также и мы тратим много времени на просмотр всех матчей 

команд, на которые предлагаем делать ставки, следим за травмами игроков, 

трансферами, информацией в СМИ, статистикой, и всем информационным 

полем вокруг матча в целом. Не хотите тратить свое время на изучение 

всего вышеперечисленного – доверьтесь профессионалам! Ведь мы хотим 

зарабатывать деньги также как Вы, именно поэтому мы ответственно подходим 

к анализу абсолютно каждого матча.
                </span>
                <span class="q-little">
                    Мы тщательно отбираем аналитиков проекта. Ярким подтверждением чего

является один из наших топ типстеров Мантис. Все новые аналитики начинают 

работать у нас, только после оценки Мантисом их квалификации.
                </span>
                <span class="q-little">
                    Наш опыт в ставках на футбол насчитывает уже более 14 лет.
                </span>
                <span class="q-little">
                    В этот проект мы вложили нашу страсть к футболу и жажду заработка на 

ставках.
                </span>
                <span class="q-caps">Сегодня мы готовы делиться своими знаниями с Вами и со всем миром.</span>
                <span class="q-romb">Если Вы действительно любите футбол так, как его любим мы...</span>
                <span class="q-romb">Если Вы хотите знать больше, чем остальные, также, как и мы...</span>
                <span class="q-romb">Если Вы хотите заработать приличные деньги на любимом деле также, как

мы...</span>
                <span class="q-romb">Если Вы хотите только радоваться результатам своих ставок также, как мы...</span>
                <span class="q-little">
                    Тогда присоединяйся к команде BetonFootball сейчас и уже сегодня Вы

сможете начать зарабатывать на ставках больше, чем когда-либо ранее, а завтра 

Вы позволите себе купить то, о чем давно мечтали.
                </span>
                <span class="q-little">
                    Начинай побеждать с нами прямо сегодня. В нашей команде только самые

лучшие – такие же, как и ты!
                </span>
            </div>
        </div>
    </div>
</div>
