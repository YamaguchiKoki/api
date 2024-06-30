<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GetProfile extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
      Log::debug(print_r('kokikoi', true));
      $userId = $request->query('user_id');
      if (!$userId) {
        return response()->json(['message' => '該当するユーザーが存在しませんでした'], 404);
      }
      $user = User::with(['playlists.songs', 'likes', 'followers', 'snsLinks.provider'])->find($userId);
      Log::debug(print_r($user, true));
      return response()->json($user);
    }

  //   {
  //     "id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //     "screen_name": "Test User",
  //     "email": "email@example.com",
  //     "status": 0,
  //     "bio": null,
  //     "image_url": null,
  //     "created_at": "2024-06-25T07:27:23.000000Z",
  //     "updated_at": "2024-06-25T07:27:23.000000Z",
  //     "playlists": [
  //         {
  //             "id": "01j174nk679qqje1bc9j5x2gxt",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "ずんずん沈しずめるんだねえ。。",
  //             "description": "むかい青年は男の子はまるで夢中むちゅう、水晶すいの高い車掌しゃしょうめんに丘おかを走ったりで言いい、あたりは思わず二人ふたりの燈火あかりの火やはげしげみのようと船の沈しずみかづきがざわ鳴っているかぐあいがいと思って、前の方へ洲すのが鳴っていくるした。線路せんの博士はかせの前の六つばかり小さかの神かみの桜さく小さまが見えるなど、その奥おくへ投なげた人もあてをひろっこうふうにきた。それはいいなベンチも置おいつをはいけないてその三つ曲まがおりて見ような白い渚なぎさにまるで鉄砲弾てったので、男の子の手首てくすっかさね直なおして、その地平線ちへいせいですよ」さっきりに黒い大きく、立派りって行きました。ジョバンニは、さや風にゆっくらに浮ういじりながら、どこからほのお母さんがの青じろい環わとがあったでした。「ああほんとうの方へ走りました。向むこうのひとりとりがくしい天の川の左の岸きしを進すすきとおもいながらんとうに、もう見えました。左手にもついたろうかと言いいました厚あつめたとよく言いいました。おりか一つずつでもたしたように、わあいがくの青光あおびかの神かみに似にているだけどい峡谷きょうはしい気。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 1,
  //                     "playlist_id": "01j174nk679qqje1bc9j5x2gxt",
  //                     "name": "Doloribus et qui impedit autem repellat aut corrupti similique.",
  //                     "order": 1,
  //                     "url": "https://www.wakamatsu.com/aut-ut-consectetur-illum-minus",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 2,
  //                     "playlist_id": "01j174nk679qqje1bc9j5x2gxt",
  //                     "name": "Voluptas at blanditiis doloribus atque occaecati.",
  //                     "order": 2,
  //                     "url": "https://kanou.biz/minima-aut-dolore-quia-optio-molestiae-sint.html",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 3,
  //                     "playlist_id": "01j174nk679qqje1bc9j5x2gxt",
  //                     "name": "Dicta et praesentium id autem consequatur.",
  //                     "order": 7,
  //                     "url": "https://www.yoshida.com/dolorem-consequatur-iste-laborum-ipsam-quasi-est-similique",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 4,
  //                     "playlist_id": "01j174nk679qqje1bc9j5x2gxt",
  //                     "name": "Voluptas quia nobis occaecati et sit nam sint quasi.",
  //                     "order": 8,
  //                     "url": "http://matsumoto.com/ducimus-officia-reprehenderit-et-minus-ea",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 5,
  //                     "playlist_id": "01j174nk679qqje1bc9j5x2gxt",
  //                     "name": "Vero doloribus dolorem vel doloribus voluptatem cupiditate.",
  //                     "order": 2,
  //                     "url": "http://kiriyama.biz/",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         },
  //         {
  //             "id": "01j174nk6cp2re3v32w0v8hpn5",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "んしゅらしい方さ。ここは。",
  //             "description": "ひっしゃると思うとうの窓まどから、声もたしはじめます。ジョバンニは、とこでした。するとたんだからぼうしているというふうに長く延のびるのでした。向むこうと船の沈しずかなし）「ボートよりがとうの星雲せいでそれはここでなしそっちがした金いろの紙をジョバンニは、指ゆびをたててしまって行ったのです。それを二つばかりふりうごいたい何です」「うん、なんに走りは、さっそく正しく行ったよ」「あなかったといつでもかまわすと、二度どに開いて信号標しんくうか」いましたようになって見ように答えました。「よろこしにね、舟ふねがゆれたのように見えその羽根はねをひたしまい、僕ぼくたちこち咲さいて見て、眼めにいちばしをふしぎなものや蛇へびや魚や瓶びんの柱はしきものは大学士だいに大学士だいかとして、森の中からくしく規則きそくしかったり、十日もつも見たようにま。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 6,
  //                     "playlist_id": "01j174nk6cp2re3v32w0v8hpn5",
  //                     "name": "Enim tempore autem dolor nihil ipsum debitis distinctio.",
  //                     "order": 1,
  //                     "url": "https://www.idaka.com/aut-perspiciatis-ipsum-eos-ab-quibusdam-vitae",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 7,
  //                     "playlist_id": "01j174nk6cp2re3v32w0v8hpn5",
  //                     "name": "Cumque earum non et qui voluptatem laudantium rerum.",
  //                     "order": 2,
  //                     "url": "http://fujimoto.com/molestias-voluptatem-nemo-esse-blanditiis-est-asperiores-distinctio",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 8,
  //                     "playlist_id": "01j174nk6cp2re3v32w0v8hpn5",
  //                     "name": "Quisquam necessitatibus aperiam qui placeat quia.",
  //                     "order": 7,
  //                     "url": "http://sasada.com/",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 9,
  //                     "playlist_id": "01j174nk6cp2re3v32w0v8hpn5",
  //                     "name": "Explicabo amet modi sit qui quibusdam.",
  //                     "order": 5,
  //                     "url": "https://sasaki.jp/assumenda-aut-repellendus-adipisci-dolores-quaerat.html",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 10,
  //                     "playlist_id": "01j174nk6cp2re3v32w0v8hpn5",
  //                     "name": "Repellendus eligendi repellendus tenetur ipsa saepe.",
  //                     "order": 3,
  //                     "url": "http://www.hirokawa.jp/nemo-qui-possimus-in-sunt-voluptatem",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         },
  //         {
  //             "id": "01j174nk6gjqj3zrt4zsg3nsz8",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "を出し抜ぬけだから」カム。",
  //             "description": "おきて赤い毛もちは参観さんお話しかけたよ。だけどねえ」「カムパネルラをまげたりましたらい牛舎ぎゅうを持もちが軽かるくるっと経済けいのって大きなりまわりとも言いいました。その人どころに来ました。その地歴ちれつをゆるやかに微笑わらい小さな船に乗のり出されてきゅうを買っているのがだかわいに光って行くよ。けれども昔むかしいかにいろ指図さして誰だれだかおると解とから暗くらいだから帰ること」女の子はまた水の中をまたにちが、手帳てちょう」カムパネルラがまるで遠くかがくしく立っていた大きく振ふって来たり笑わらなったことでも着つい硝子ガラスよりはこんなは乗のっけんですかにうたっと向むこうふうに、車室に、もうそこには青くすって行きました。「さあ」「うん。ぼくたちのお宮みやだい」鳥捕とり、イン。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 11,
  //                     "playlist_id": "01j174nk6gjqj3zrt4zsg3nsz8",
  //                     "name": "Nisi qui inventore sunt officia.",
  //                     "order": 3,
  //                     "url": "http://www.takahashi.net/",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 12,
  //                     "playlist_id": "01j174nk6gjqj3zrt4zsg3nsz8",
  //                     "name": "Ut quo quia ut eos.",
  //                     "order": 5,
  //                     "url": "http://www.nakatsugawa.jp/eum-quibusdam-et-blanditiis-at.html",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 13,
  //                     "playlist_id": "01j174nk6gjqj3zrt4zsg3nsz8",
  //                     "name": "Ea omnis excepturi ut iste.",
  //                     "order": 6,
  //                     "url": "http://www.kijima.net/in-ullam-consectetur-blanditiis-perspiciatis-iure-quas",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 14,
  //                     "playlist_id": "01j174nk6gjqj3zrt4zsg3nsz8",
  //                     "name": "Voluptatibus dicta non dolores dolor delectus et.",
  //                     "order": 1,
  //                     "url": "http://saito.com/dolorum-exercitationem-est-ut-nihil-nihil-neque-et-ipsum.html",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 15,
  //                     "playlist_id": "01j174nk6gjqj3zrt4zsg3nsz8",
  //                     "name": "Dicta quam ab neque ut dicta.",
  //                     "order": 5,
  //                     "url": "https://hirokawa.com/quam-voluptatem-vel-commodi-quis-quia-suscipit-et.html",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         },
  //         {
  //             "id": "01j174nk6p0jn3nyc9abh2v6pc",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "かから、大きくもう行って後光の反射。",
  //             "description": "ビーよりも歴史れきのどくそこを指さした空から包つつんだ。ここは勾配こう岸ぎして言いう鳥の停車場ているのような気がしに二本のあかり、どうしろかがください」ああ、ぼく知ってきた。時計とけるな緑みどりのようにならべて行って、こいつは鳥の群むれがたってから元気にしました。「どうの窓まどの外から、さっそくいろのさそりは顔をしてジョバンニは窓まどを見ました。向むこうの」ジョバンニは思われるとみんな星はみんなさいわの窓まどの人馬がゆっくらいどこまでおいた、わざと胸むねを張はっと光っていたジョバンニが思いました。ジョバンニがまるでざわざわしてわざとうだ」「カムパネルラが、まるで粟粒あわせかいがんがの水にひらけました。ジョバンニも全まって。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 16,
  //                     "playlist_id": "01j174nk6p0jn3nyc9abh2v6pc",
  //                     "name": "Quia ex odio expedita rerum repellendus voluptatem.",
  //                     "order": 10,
  //                     "url": "http://aoyama.com/",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 17,
  //                     "playlist_id": "01j174nk6p0jn3nyc9abh2v6pc",
  //                     "name": "Quia id in repellat hic.",
  //                     "order": 6,
  //                     "url": "https://sato.jp/nulla-est-maiores-cumque-fugiat.html",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 18,
  //                     "playlist_id": "01j174nk6p0jn3nyc9abh2v6pc",
  //                     "name": "Aut ipsum facere itaque aperiam ut architecto.",
  //                     "order": 8,
  //                     "url": "http://www.kondo.jp/impedit-pariatur-aut-qui-dolor-ipsum-soluta-culpa",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 19,
  //                     "playlist_id": "01j174nk6p0jn3nyc9abh2v6pc",
  //                     "name": "Repellat omnis non laborum necessitatibus omnis eveniet.",
  //                     "order": 4,
  //                     "url": "http://saito.jp/error-nisi-non-quis",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 20,
  //                     "playlist_id": "01j174nk6p0jn3nyc9abh2v6pc",
  //                     "name": "Veritatis molestiae perspiciatis voluptatum ipsam tenetur.",
  //                     "order": 5,
  //                     "url": "http://www.ekoda.com/atque-possimus-excepturi-ducimus-ut-rerum",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         },
  //         {
  //             "id": "01j174nk6t75khdfr14s6qn9mr",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "しくて、いました。とこなんから。",
  //             "description": "うと、そして言いい実験じって行くようにしょか何かたなかの前に立っているかどからすうっと、その下からだが、まもなしい楽器がった」ごとのあるものでもこっちへ進すすきがかなしに行ける勇気ゆうきのようここででも私の心をごらん、その人はしずかにうちにくるし僕ぼくおじぎをたべるようにいたのだ。さあ、そこにこわくなら何があってきましたして私たちの流ながら言いった帽子ぼうっとその渚なぎさに行こうにジョバンニの眼めを見て、また走りました。ジョバンニはまっ黒な上着うわぎのポケットに入れて立ちど手にもこわされるように、お母さんたいらっしゃっ。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 21,
  //                     "playlist_id": "01j174nk6t75khdfr14s6qn9mr",
  //                     "name": "Sunt eos aut ipsa magnam ratione quisquam cumque ut.",
  //                     "order": 5,
  //                     "url": "https://tsuda.com/dolor-iusto-rerum-qui-aut-voluptas.html",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 22,
  //                     "playlist_id": "01j174nk6t75khdfr14s6qn9mr",
  //                     "name": "Facilis explicabo ut perferendis et aut sunt.",
  //                     "order": 6,
  //                     "url": "http://suzuki.com/",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 23,
  //                     "playlist_id": "01j174nk6t75khdfr14s6qn9mr",
  //                     "name": "Aperiam aut quibusdam quo repudiandae et.",
  //                     "order": 7,
  //                     "url": "http://www.nagisa.net/at-voluptatem-consequuntur-aliquid-repudiandae-labore-aliquid-sint.html",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 24,
  //                     "playlist_id": "01j174nk6t75khdfr14s6qn9mr",
  //                     "name": "Dolorem odio magnam aut occaecati voluptatem assumenda incidunt praesentium.",
  //                     "order": 8,
  //                     "url": "http://hamada.jp/",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 25,
  //                     "playlist_id": "01j174nk6t75khdfr14s6qn9mr",
  //                     "name": "Natus rerum consequatur blanditiis distinctio.",
  //                     "order": 4,
  //                     "url": "http://miyazawa.biz/",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         },
  //         {
  //             "id": "01j174nk6xnwkahds6bvx49fq7",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "ばらく、お早う」ジョバンニが言いいまし。",
  //             "description": "うちに銀ぎんがたくしくあすこはコロラドの高原じゃないうように光っていしゃがみんなそうかな銀河ぎんがのはじぶん走って、また、高く高く高く口笛くちぶえを吹ふいて通ってしずかなしに沿そっちょうの汁しるして戻もどりの火、その学者がくした。「ぼくたちは神かみさまで睡ねむってだまっ白な、あの人に出してきた人たちまうのできてまた窓まどを曲まが見え、そうでした。けれどこから六千尺じゃくから」そのほんとした。つまりも下りで言いいました人たちをしてまるならんだかわるい板いたしまってしました。「このけようなずきまわりにはなれているんです。子ども、これから、ジョバンニたちの流ながら言いいね」鳥捕とりは、（そうに書いたのでしたカトリックふうですよ」青年はほんと立ちながら叫さけんかいなずきました。二人ふたちは思いました。なんだんだなかったり暗くらにわかにめぐって来くるといつからだって行きまってこうのですから女の子が赤い帽子ぼうえんきりんごをして待まってできるように、もう時間になりません。苹果りんごくへはいた。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 26,
  //                     "playlist_id": "01j174nk6xnwkahds6bvx49fq7",
  //                     "name": "Sed aut deleniti voluptatem optio est id autem.",
  //                     "order": 8,
  //                     "url": "http://www.ekoda.biz/doloribus-mollitia-illo-nam-deleniti",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 27,
  //                     "playlist_id": "01j174nk6xnwkahds6bvx49fq7",
  //                     "name": "At molestias necessitatibus voluptatem sit quisquam amet.",
  //                     "order": 6,
  //                     "url": "http://yamamoto.com/at-in-aut-iusto",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 28,
  //                     "playlist_id": "01j174nk6xnwkahds6bvx49fq7",
  //                     "name": "Sed quo sequi et aut velit.",
  //                     "order": 4,
  //                     "url": "http://ishida.jp/rerum-quia-delectus-sequi-minima-est",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 29,
  //                     "playlist_id": "01j174nk6xnwkahds6bvx49fq7",
  //                     "name": "Ea saepe voluptas amet deleniti ut non.",
  //                     "order": 1,
  //                     "url": "http://www.tanabe.org/",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 30,
  //                     "playlist_id": "01j174nk6xnwkahds6bvx49fq7",
  //                     "name": "Praesentium rerum ea ea provident cum.",
  //                     "order": 8,
  //                     "url": "http://uno.jp/corporis-et-ullam-veritatis-id",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         },
  //         {
  //             "id": "01j174nk71tf1fcbedyhknyw58",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "にすると言いいから前の白い柔やわら。",
  //             "description": "とを言いいました。その大きなんだん十字架じゅずを、一々考えたのでしたが、ジョバンニ、おかし雁がんきり聞こえジョバンニはいつまっ黒に立ってお祈いのでした。「もう涼すずしなかったりますとしました。どこまかないほど深ふかんしゅうになにか黒い丘おかにうつくころがカムパネルラが地べたりはじめました。いや、いつ」「そこらえてる。もうこのくるみの中をもっと消きえたちいちめんの時間で行く街道かいことならばかりひる学校で見たよう、なについたいしがみんなことを思い直なお魚もいたのさまをつかったのような気がしてくれて、それにしてながれと同じように苹果りんこうきなオーケストリイのように、白鳥停車場ている間その上にもっておっかさんは一時かったのだ。さそりのんでした。するとも言いいましましたり、ジョバンニは、暗やみのように川上のしるのでもわざと穫とれ本気に手をひたしたがたが、思い切ったよ。銀河鉄道線路せん。あとかすんですか。ではこおりなさんのちぢめて向むこうに高くなって、うつって、「どらせ。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 31,
  //                     "playlist_id": "01j174nk71tf1fcbedyhknyw58",
  //                     "name": "Amet aut commodi vero similique deleniti velit iusto officiis.",
  //                     "order": 6,
  //                     "url": "http://kiriyama.jp/explicabo-tempore-ratione-suscipit-voluptates-inventore-commodi.html",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 32,
  //                     "playlist_id": "01j174nk71tf1fcbedyhknyw58",
  //                     "name": "Est et eveniet ullam provident.",
  //                     "order": 4,
  //                     "url": "http://www.tsuda.jp/",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 33,
  //                     "playlist_id": "01j174nk71tf1fcbedyhknyw58",
  //                     "name": "Placeat deserunt natus eum voluptatem.",
  //                     "order": 10,
  //                     "url": "http://tanabe.com/",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 34,
  //                     "playlist_id": "01j174nk71tf1fcbedyhknyw58",
  //                     "name": "Corporis tenetur fugit magnam quo voluptatibus quia animi.",
  //                     "order": 1,
  //                     "url": "http://kiriyama.com/nesciunt-sed-sunt-aliquam-quo-pariatur",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 35,
  //                     "playlist_id": "01j174nk71tf1fcbedyhknyw58",
  //                     "name": "Et sequi fugit vitae atque qui nesciunt sit.",
  //                     "order": 10,
  //                     "url": "http://suzuki.org/natus-veritatis-eligendi-dolorem-vitae-repellat-et-consequatur-voluptatibus",
  //                     "url_type": "youtube",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         },
  //         {
  //             "id": "01j174nk753m3y3e1hg6bn420c",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "銅どうの、影かげぼうっとか。",
  //             "description": "きた人が邪魔じゃないか」女の子が言いいました。ここは勾配こうふうに思いました。ジョバンニは靴くつをぬぐいなように、おいおうと、そっとそうで二尺も孔あなたく、頬ほおをぴくぴくしてくれたねえさんですね」その上に一生けん命めい延のびあがりません、りんてこっちでいるからで包つつんですね」「ええ、蠍さそりは、かえって、ほんとした。「ぼくにくるみのおかのからだ）とおっかり、スコップで走るとまわりますと、ぼくはそのままま胸むねが熱あつめたく早く鳥がたくしくの四、五人手を出してたべましたのでした。その星はみんな神かみさまだ、もうたびしそうにキスを塗ぬって見ていながら、缶かんしゃばの広いせわした。「おかを一つの、水は声もかまってとるんだからすうなようの神かみさまの形を逆ぎゃくに見えました。向むこう岸ぎしにね、鷺さぎをしっかりの時間半はんしつれていて行きますと、すきの蠍さそりの字を印刷いんだものの上に立って食べるだろうか、泣なきだしいねいになった測量旗そくりおなじことでなし）とジョバンニは玄関げんか。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 36,
  //                     "playlist_id": "01j174nk753m3y3e1hg6bn420c",
  //                     "name": "Ad nulla dolorem aut qui.",
  //                     "order": 10,
  //                     "url": "http://sugiyama.jp/accusantium-dolorem-tempora-et-magni",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 37,
  //                     "playlist_id": "01j174nk753m3y3e1hg6bn420c",
  //                     "name": "Eum veniam omnis voluptas.",
  //                     "order": 6,
  //                     "url": "http://sato.com/ratione-quisquam-dolorem-rem-quae",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 38,
  //                     "playlist_id": "01j174nk753m3y3e1hg6bn420c",
  //                     "name": "Deserunt voluptatem eos praesentium aliquam.",
  //                     "order": 1,
  //                     "url": "https://www.hirokawa.info/nostrum-voluptatem-dolorem-et-aut-ducimus",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 39,
  //                     "playlist_id": "01j174nk753m3y3e1hg6bn420c",
  //                     "name": "Est soluta excepturi tempore rerum ipsam rem.",
  //                     "order": 4,
  //                     "url": "http://nishinosono.info/",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 40,
  //                     "playlist_id": "01j174nk753m3y3e1hg6bn420c",
  //                     "name": "Dolor eaque minima culpa magni hic excepturi.",
  //                     "order": 4,
  //                     "url": "http://www.hamada.net/temporibus-nihil-ea-quia-sit-consequatur-rerum",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         },
  //         {
  //             "id": "01j174nk7b299ghyzv23gam9fa",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "みを持もって鳥をつがえる。",
  //             "description": "て、すっかさとは紀元前きげんか」「ああマジェランプが、思いだいに大きなりました。そのままや鎖くさん集まっすぐに立ちあがった一つの小さな家でした。するともうあのさいて、じっと遠くへ行いっぱいにあかりました。すぐ前のあたしは、すすみの中にむなしかたをあけたりがせわしました。ジョバンニは、波なみをおろしなが、どこかです。つまったのさ」は底本では「「ジョバンニはもう、ここは勾配こうふうにうしてっぽだけでした。「川へ流ながれと考えるのがぼくも、みんな赤く光りんごをしました。けれどもらはなして一本あげて泣ないだから」女の子が顔を出して、ちょうかと言いったたか一。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 41,
  //                     "playlist_id": "01j174nk7b299ghyzv23gam9fa",
  //                     "name": "Amet officia minima aspernatur.",
  //                     "order": 10,
  //                     "url": "http://www.sugiyama.jp/rerum-iste-aspernatur-hic-ut-rerum-adipisci",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 42,
  //                     "playlist_id": "01j174nk7b299ghyzv23gam9fa",
  //                     "name": "Sapiente nostrum facere aut saepe est unde placeat dolorum.",
  //                     "order": 10,
  //                     "url": "http://www.watanabe.com/molestiae-nulla-tempore-nobis-consequatur-quia-repudiandae-aperiam",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 43,
  //                     "playlist_id": "01j174nk7b299ghyzv23gam9fa",
  //                     "name": "Numquam rerum quis inventore ex vero vitae.",
  //                     "order": 6,
  //                     "url": "http://yoshida.jp/rerum-ullam-expedita-consequatur-voluptates-perferendis",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 44,
  //                     "playlist_id": "01j174nk7b299ghyzv23gam9fa",
  //                     "name": "Autem et sit voluptas necessitatibus neque quae.",
  //                     "order": 9,
  //                     "url": "http://sasada.com/",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 45,
  //                     "playlist_id": "01j174nk7b299ghyzv23gam9fa",
  //                     "name": "Natus et ut modi nihil eius qui.",
  //                     "order": 5,
  //                     "url": "http://www.ogaki.jp/occaecati-sit-tenetur-aut",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         },
  //         {
  //             "id": "01j174nk7f7tqv1246cf2z33yf",
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "name": "つのは、次つぎのちりとりは、こ。",
  //             "description": "におい、ほんとうがたった硝子ガラスの葉はの玉たままにそむく、ある。いま誰だれが惜おし葉ばにすると、そっちの方を知って、もうザネリはもちをごらんでした。六時がうつくしくなりました。鷺さぎのようにゅうに川だとジョバンニは首くびをまわすとした。すこに行っちへ、「お母さんそうだ。今日きょう」「僕ぼくのお星さまって一ぺんにいるのだ。いかたっていきおいて、ここの間、川下の遠いものですから暗くらな。それはだし、第一だいものが水からかの波なみだが。今日か昨日おとさせて盤ばん下流かりの字を印刷いんでこさえるのでした。「ああ、こうなずきれをよく言いえずにぎっていました。「海豚いる影かげもなくて立ってらいことは指ゆびできますけたように、縮ちぢれ葉はの下に大きな音ねいにつるされて来てとまわしにお祭まつりだしです。草の中はしらも出たり、電しんぱいした。「今晩こんなその。",
  //             "image_url": null,
  //             "added_to_bookshelf_count": 0,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "songs": [
  //                 {
  //                     "id": 46,
  //                     "playlist_id": "01j174nk7f7tqv1246cf2z33yf",
  //                     "name": "Qui quod veniam ut ducimus.",
  //                     "order": 1,
  //                     "url": "https://sakamoto.com/explicabo-repellendus-eveniet-sunt.html",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 47,
  //                     "playlist_id": "01j174nk7f7tqv1246cf2z33yf",
  //                     "name": "Iure qui quia expedita a aperiam ullam.",
  //                     "order": 8,
  //                     "url": "http://aota.org/nesciunt-non-quos-exercitationem-minus-in",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 48,
  //                     "playlist_id": "01j174nk7f7tqv1246cf2z33yf",
  //                     "name": "Velit corporis autem vel accusantium in.",
  //                     "order": 7,
  //                     "url": "https://www.nishinosono.jp/quia-dolores-aut-officiis-et",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 49,
  //                     "playlist_id": "01j174nk7f7tqv1246cf2z33yf",
  //                     "name": "Sit at aut quisquam qui placeat.",
  //                     "order": 7,
  //                     "url": "http://murayama.net/et-aut-ad-debitis-est-ipsa",
  //                     "url_type": "apple_music",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 },
  //                 {
  //                     "id": 50,
  //                     "playlist_id": "01j174nk7f7tqv1246cf2z33yf",
  //                     "name": "Totam aut ipsam autem perferendis aperiam eos unde quasi.",
  //                     "order": 2,
  //                     "url": "http://watanabe.com/",
  //                     "url_type": "spotify",
  //                     "created_at": "2024-06-25T07:27:23.000000Z",
  //                     "updated_at": "2024-06-25T07:27:23.000000Z"
  //                 }
  //             ]
  //         }
  //     ],
  //     "likes": [
  //         {
  //             "id": 1,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nkdt8veq9vk4w0e4jxeh",
  //             "created_at": null,
  //             "updated_at": null
  //         },
  //         {
  //             "id": 2,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nkdxe2ernhepfsct846r",
  //             "created_at": null,
  //             "updated_at": null
  //         },
  //         {
  //             "id": 3,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nkdz42etjjmcsjcjer7t",
  //             "created_at": null,
  //             "updated_at": null
  //         },
  //         {
  //             "id": 4,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nke6dktnmd4jxnhyb0ym",
  //             "created_at": null,
  //             "updated_at": null
  //         },
  //         {
  //             "id": 5,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nke9pqxzmn3ffwbtgyzf",
  //             "created_at": null,
  //             "updated_at": null
  //         },
  //         {
  //             "id": 6,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nkebj3fx2pz2hfdvenrr",
  //             "created_at": null,
  //             "updated_at": null
  //         },
  //         {
  //             "id": 7,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nkefpcsx2z2fzez71qn0",
  //             "created_at": null,
  //             "updated_at": null
  //         },
  //         {
  //             "id": 8,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nkehjma0fytc671wgqvf",
  //             "created_at": null,
  //             "updated_at": null
  //         },
  //         {
  //             "id": 9,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nkemz0jw0v63cmsbntzk",
  //             "created_at": null,
  //             "updated_at": null
  //         },
  //         {
  //             "id": 10,
  //             "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //             "playlist_id": "01j174nkesy0nre5f3cnv9kjfd",
  //             "created_at": null,
  //             "updated_at": null
  //         }
  //     ],
  //     "followers": [
  //         {
  //             "id": "d9bbe158-a145-4bb2-9c43-04c5cd0248a2",
  //             "screen_name": "Test follower",
  //             "email": "follower@example.com",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "d9bbe158-a145-4bb2-9c43-04c5cd0248a2"
  //             }
  //         },
  //         {
  //             "id": "5866e990-2c3f-4964-8209-024600bfb7f2",
  //             "screen_name": "加藤 健一",
  //             "email": "nagisa.kumiko@example.net",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "5866e990-2c3f-4964-8209-024600bfb7f2"
  //             }
  //         },
  //         {
  //             "id": "945b4731-563e-4f89-a698-8f5c5232c48c",
  //             "screen_name": "井高 結衣",
  //             "email": "kaori09@example.org",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "945b4731-563e-4f89-a698-8f5c5232c48c"
  //             }
  //         },
  //         {
  //             "id": "0cc37f3d-497f-43c6-b227-33d5434a2562",
  //             "screen_name": "宇野 稔",
  //             "email": "kyosuke83@example.com",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "0cc37f3d-497f-43c6-b227-33d5434a2562"
  //             }
  //         },
  //         {
  //             "id": "15ca0174-e555-4934-a411-d4d80fcff0cf",
  //             "screen_name": "渡辺 七夏",
  //             "email": "kazuya.nagisa@example.org",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "15ca0174-e555-4934-a411-d4d80fcff0cf"
  //             }
  //         },
  //         {
  //             "id": "6b340e7f-327e-4bd8-905e-547ec81c9d0a",
  //             "screen_name": "木村 翔太",
  //             "email": "dkobayashi@example.net",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "6b340e7f-327e-4bd8-905e-547ec81c9d0a"
  //             }
  //         },
  //         {
  //             "id": "5e1538d1-707b-4727-a1d5-fe486b22bfa2",
  //             "screen_name": "山田 知実",
  //             "email": "xnagisa@example.com",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "5e1538d1-707b-4727-a1d5-fe486b22bfa2"
  //             }
  //         },
  //         {
  //             "id": "d429b7fe-8fb4-40bb-8f17-9d172994b53f",
  //             "screen_name": "吉本 淳",
  //             "email": "haruka02@example.com",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "d429b7fe-8fb4-40bb-8f17-9d172994b53f"
  //             }
  //         },
  //         {
  //             "id": "85b8f708-75cf-40a9-8ad8-76f468138ff6",
  //             "screen_name": "加納 舞",
  //             "email": "ikijima@example.org",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "85b8f708-75cf-40a9-8ad8-76f468138ff6"
  //             }
  //         },
  //         {
  //             "id": "18452e87-5fe7-4e8e-a743-0826a2c7c360",
  //             "screen_name": "浜田 淳",
  //             "email": "gkijima@example.com",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "18452e87-5fe7-4e8e-a743-0826a2c7c360"
  //             }
  //         },
  //         {
  //             "id": "7f8e468a-d029-4161-92b0-33c93ccbd934",
  //             "screen_name": "渡辺 晃",
  //             "email": "tomoya49@example.org",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "followee_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "follower_id": "7f8e468a-d029-4161-92b0-33c93ccbd934"
  //             }
  //         }
  //     ],
  //     "followees": [
  //         {
  //             "id": "0f2e4bd1-6257-4ee1-ba45-2218964cfc7d",
  //             "screen_name": "三宅 あすか",
  //             "email": "maaya71@example.net",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "0f2e4bd1-6257-4ee1-ba45-2218964cfc7d"
  //             }
  //         },
  //         {
  //             "id": "185a9696-06f4-42af-87f2-af1ea1087cc0",
  //             "screen_name": "中津川 治",
  //             "email": "shota.kondo@example.net",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "185a9696-06f4-42af-87f2-af1ea1087cc0"
  //             }
  //         },
  //         {
  //             "id": "2199a2c3-25d4-4ef9-9521-18cce0b9a1db",
  //             "screen_name": "田辺 直樹",
  //             "email": "manabu.takahashi@example.com",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "2199a2c3-25d4-4ef9-9521-18cce0b9a1db"
  //             }
  //         },
  //         {
  //             "id": "3c0910e1-feee-474e-970a-ee08d97f0db5",
  //             "screen_name": "加納 和也",
  //             "email": "miki.kanou@example.net",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "3c0910e1-feee-474e-970a-ee08d97f0db5"
  //             }
  //         },
  //         {
  //             "id": "47cff210-be2b-4f81-8efc-4cf2407749ac",
  //             "screen_name": "津田 太郎",
  //             "email": "uaoyama@example.net",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "47cff210-be2b-4f81-8efc-4cf2407749ac"
  //             }
  //         },
  //         {
  //             "id": "606c6d80-61e8-4692-a541-8f6b85f0ce60",
  //             "screen_name": "加藤 聡太郎",
  //             "email": "rnagisa@example.org",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "606c6d80-61e8-4692-a541-8f6b85f0ce60"
  //             }
  //         },
  //         {
  //             "id": "6487a3dc-692c-4730-bbf8-61ba17f269ea",
  //             "screen_name": "Test followee",
  //             "email": "followee@example.com",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:23.000000Z",
  //             "updated_at": "2024-06-25T07:27:23.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "6487a3dc-692c-4730-bbf8-61ba17f269ea"
  //             }
  //         },
  //         {
  //             "id": "6a4175ea-5ce0-4b65-aca7-8fbb576a8170",
  //             "screen_name": "井高 京助",
  //             "email": "asuzuki@example.org",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "6a4175ea-5ce0-4b65-aca7-8fbb576a8170"
  //             }
  //         },
  //         {
  //             "id": "b42a4f8c-a662-43ce-86c2-a2a7b18318fd",
  //             "screen_name": "桐山 加奈",
  //             "email": "asuka.murayama@example.net",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "b42a4f8c-a662-43ce-86c2-a2a7b18318fd"
  //             }
  //         },
  //         {
  //             "id": "b639da0a-45f2-45a2-b1e7-95ff04281c66",
  //             "screen_name": "宇野 修平",
  //             "email": "rika19@example.net",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "b639da0a-45f2-45a2-b1e7-95ff04281c66"
  //             }
  //         },
  //         {
  //             "id": "e029810a-6b33-44a0-b6fd-5d22df19f93a",
  //             "screen_name": "近藤 裕太",
  //             "email": "shota92@example.org",
  //             "status": 0,
  //             "bio": null,
  //             "image_url": null,
  //             "created_at": "2024-06-25T07:27:24.000000Z",
  //             "updated_at": "2024-06-25T07:27:24.000000Z",
  //             "pivot": {
  //                 "follower_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "followee_id": "e029810a-6b33-44a0-b6fd-5d22df19f93a"
  //             }
  //         }
  //     ],
  //     "sns_providers": [
  //         {
  //             "id": 1,
  //             "provider_name": "Twitter",
  //             "created_at": null,
  //             "updated_at": null,
  //             "pivot": {
  //                 "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "provider_id": 1,
  //                 "sns_user_id": "example_sns_user_id_1",
  //                 "created_at": "2024-06-25T07:27:24.000000Z",
  //                 "updated_at": "2024-06-25T07:27:24.000000Z"
  //             }
  //         },
  //         {
  //             "id": 2,
  //             "provider_name": "Spotify",
  //             "created_at": null,
  //             "updated_at": null,
  //             "pivot": {
  //                 "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "provider_id": 2,
  //                 "sns_user_id": "example_sns_user_id_2",
  //                 "created_at": "2024-06-25T07:27:24.000000Z",
  //                 "updated_at": "2024-06-25T07:27:24.000000Z"
  //             }
  //         },
  //         {
  //             "id": 3,
  //             "provider_name": "Apple Music",
  //             "created_at": null,
  //             "updated_at": null,
  //             "pivot": {
  //                 "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "provider_id": 3,
  //                 "sns_user_id": "example_sns_user_id_3",
  //                 "created_at": "2024-06-25T07:27:24.000000Z",
  //                 "updated_at": "2024-06-25T07:27:24.000000Z"
  //             }
  //         },
  //         {
  //             "id": 4,
  //             "provider_name": "Instagram",
  //             "created_at": null,
  //             "updated_at": null,
  //             "pivot": {
  //                 "user_id": "b17498ca-36bb-4ba8-88d1-b35351015266",
  //                 "provider_id": 4,
  //                 "sns_user_id": "example_sns_user_id_4",
  //                 "created_at": "2024-06-25T07:27:24.000000Z",
  //                 "updated_at": "2024-06-25T07:27:24.000000Z"
  //             }
  //         }
  //     ]
  // }
}
