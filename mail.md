# 为什么要使用OctoberCMS

工作中接触的CMS系统比较少，基本上独立开发功能。所以比较多的内容，属于是道听途说和自己的一点心得体会。听过的CMS系统有：WordPress、Drupal、OctoberCMS、帝国、Dede、thinkOne、thinkcmf。
就这些系统的优缺点，本来是做了个比较的。但是考虑到既然贵司已经使用了，那么这些比较其实也没什么太大的意义。就说说个人的理解。
以上提到的CMS系统，都是可以用来做基础框架二次开发。是否选择某个框架，关键看项目的复杂程度、交付时间和项目的具体要求。

* 如果某个公司找你来，只是想建立一个公司首页，只是想发发新闻、发发图片动态。那么直接选择最简单的方式即可。因为不用考虑太多后继的内容。这个时候，其实是可以毫不犹豫的使用某些不被看好的框架，如WordPress或者更简单的thinkcmf。
* 如果是一个比较大型，需要长期不段更新维护的项目，那么就不能单单只注重效率。还要考虑稳健和扩展性强的框架。
* 就框架而言，热门的框架基本，如Symfony、laravel等都能够在开发效率和可扩展性都是非常不错的。但是就接受度来说，laravel的接受和流行程序，在国内来说，应该是超过Symfony的。很多人，就算没吃过猪肉，起码是见过猪跑的。
* 然而，laravel就像一个全栈框架（好像他就努力成为这样），而且非常的自由，是真的很自由。但对于大型的开发和团队的配合，这并不是一个好事情。个人认为原因如下：
    - **没有模块**
        + 首先不是说laravel就不能有模块。虽然可以通过使用Providers的模式来进行。但是需要团队制定相应的规则，不然也很容易乱套。
        + 在多人开发协作的环境下，每个人应该是负责不同的模块。没有约定的开发应该会是一场灾难。
    - **没有插件**
        + 跟模块一样，laravel本身是没有插件的，这是需要自己定制的内容。
        + 插件的好处是与核心的藕合度低，而且方便扩展。
    - **没有CMS基本的轮子**
        + laravel本身没有基本的轮子，比如说页面发布，前台后布局等。
        + 这些当然可以直接用laravel开发。但是每一套系统都要重新开发，毕竟是不合适的。
* 在这样的前提下，OctoberCMS填补了这样一些空白。不仅已经搭建好各种模块，还有超强的开发者社区支持，也有非常丰富的插件可以使用，虽然有些是要收费的，而且也需要付出一些学习的成本，但对于它提供的便利性，应该都是非常值得的。所以，选择OctoberCMS何乐而不为呢？
* 当然喽，只要在规范的情况下，laravel也是非常好用于团队开发的。
* 上面好像说多了，应该一句话就好了：人家都有了，干嘛还要造轮子？

# laraOct主要功能实现

## OctoberCMS的基本开发流程
OctoberCMS的扩展主要有两种形式。一种是modules，一种是plugin。根据邮件里面提到的内容，基本上都可以通过plugin的形式来实现基本的功能需求。modules的形式，下文也有相应内容的描述。主要描述一下个人对于OctoberCMS的开发流程。
流程如下：

* 创建plugin。可以使用命令行create:plugin，也可以使用Builder。推荐使用插件Builder，这是个神奇的插件。
* 配置plugin相关信息：detail、components、permissions、navigations等
* 根据项目的需求，对于前台的扩展需求，主要使用components。
* 对于后台管理系统的扩展，OctoberCMS已经定义好了根据pathinfo的路由解析，即backend/命名空间/ControllerName/ActionName的模式（yii2等好多框架都使用这样的基础路由）。所以可直接在plugin里面通过mvc模式可实现对应的效果。

## laraOct能够直接使用

基本大概的基本流程，laraOct的特性里面能够直接使用的，大概列举如下：

* 可配置性
    - OctoberCMS插件的基本内容，都可以使用后缀为.yaml的文件来配置。如后台菜单的导航栏、权限。
    - Model也可以通过类似的文件来配置相应的列表或表单。
    - 建议使用Builder插件，能够快速提高效率。

* 基础功能
    - 基础功能应该是创建页面、配置页面等内容。这个不带主题安装的OctoberCMS，完全可以支持；
    - 而对于更多的内容，比较说管理博客文章、创建论坛等，就需要使用插件了。
    - 常用的插件有Blog、User等

* 前台用户管理
    - 这个功能就需要使用User这个插件
    - 但是此插件仅提供的用户管理CURD功能，需要更多的字段或功能需要自己扩展。
    - 虽然这个插件提供了用户组的功能，但是没有提供相应的权限分配，这个是需要扩展的。

* 可配置功能：可配置功能中以自定仪表单系统为最主要的功能。其中包含数据列表和数据表单两大部分。
    - 这个可以说是OctoberCMS最强大的地方之一了。
    - 使用Model对应路径的fields.yaml和columns.yaml两个文件来配置表单和列表。


可配置功能，这个再说的具体一点。

### 关于数据列表

* 可根据配置显示罗列的字段
    - 此功能主要用于后台管理
    - 创建contorller后，要配置相应的config_list.yaml文件。修改相应的model和其他信息。
    - 后台管理中，controllers需要在implement属性里面，添加'Backend.Behaviors.FormController',    'Backend.Behaviors.ListController'这两个内容。OctoberCMS使用了一个类似trail的机制来组合不同的功能，这个东西叫Behaviors。与trail不同的是，Behaviors可以动态的改变。
    - 创建配置文件，并将文件名称存入相应的属性中。如config_list.yaml和config_form.yaml。
    - 使用columns.yaml来配置。具体的配置，可以参见代码。

* 可根据配置显示操作（查看、编辑或改变状态）
    - 这个应该是列表上方工具栏的操作。
    - 创建contorller后，可在配置文件config_list.yaml中，通过修改toolbar来改变相应的partial，以显示不同的操作。

* 支持排序
    - OctoberCMS本身就是直接排序操作的。
    - 只需要在配置文件中sortable属性即可。
    - 不仅可以让数据按照字段来排序。字段本身也可以通过拖拽来排序。cool!

### 关于数据表单

* 表单分为只读和编辑两种状态
    - 配置fields.yaml文件的disabled属性，即可实现此功能

* 可根据配置对录入数据进行校验
    - 配置fields.yaml文件的required属性，即可实现此功能

* 可根据配置进行分tab显示
    - 配置fields.yaml文件的tab属性，即可实现此功能

* 可对字段在表单中的显示先后顺序以及显示模式（分为独占一行和一行显示两个字段两种模式）进行配置
    - 先后顺序，在fields.yaml里面调整先后就可以
    - 配置fields.yaml文件的span属性，可以实现显示模式改变

* 表单字段类型
    - 支持laraOct大部分的字段
    - form field type
        * Text
        * Number
        * Password
        * Textarea
        * Dropdown
        * Radio List
        * Checkbox
        * Checkbox List
        * Switch
        * Section
        * Partial
        * Hint
        * Widget
    - Form widgets
        * Code editor
        * Color picker
        * Date picker
        * File upload
        * Record finder
        * Media finder
        * Relation
        * Repeater
        * Rich editor / WYSIWYG
        * Markdown editor
        * Tag list

* 支持列表嵌入
    - 不是特别清楚这个需要的具体含义
    - 如果只是简单的嵌入列表话，OctoberCMS是完全支持的。前提条件是表与表之间有关联
    - 创建contorller后，在implement属性里面，添加'Backend.Behaviors.RelationController'，实现关联内容。
    - 创建配置文件，并存入$relationConfig属性中。如config_relation.yaml。
    - 在配置文件中写入具体的配置即可。

## laraOct需要扩展的

### 权限体系&&数据权限控制

OctoberCMS采用的是RABC权限。原OctoberCMS的权限是在每个plugin或models里面写明权限，然后通过PermissionEditor这个FormWidgetBase在后台显示和编辑的。而对于鉴权，OctoberCMS在Controller基类中已经实现了。只需要增加一个requirePermission属性即可。
所以，如果显示进行扩展，也是需要明确权限配置和鉴权两个地方。大概思路如下：
* 首先是权限配置。权限配置也扩展成一个FormWidget。这个widget的功能主要包括：。
    - 读取数据所有数据表。最好应该是根据数据前缀对数据表进行筛选。
    - 可以使用多选下拉列表，配置相应的CURD操作。
    - 将相应权限存入数据库
* 鉴权
    - OctoberCMS除了通过controller本身的requiredPermissions属性进行鉴权外。还可以根据$this->user->hasAccess('acme.blog.*')或$this->user->hasPermission(['acme.blog.access_posts', 'acme.blog.access_categories'])进行鉴权。
    - 这个是可以继续使用的。当然，需要做扩展。比如在读取model的时候，事先判断该model是否有权限。


### 前台用户管理

向前台用户提供用户自注册功能。后台可对注册、激活、用户信息以及权限进行息管理。目前的User插件是没有权限管理的。所以需要扩展User插件model。扩展插件model一般有两种：

* 方式一：增加关联表

步骤如下：

* 创建对应的关联表，比如说user_permission表
* 在plugin的boot方法里面注册相应的扩展，比如User::extend()。而需要显示对应的字段，则需要使用User::extendFormFields。

* 方式二：在原表上扩展

步骤如下：

* 在plugin中，指明依赖的插件。
* 执行数据库迁移，即可增加相应的内容。


### 数据列表

支持自定义格式化、MultiSelect、Currency、DataTable、InfoBlock这些是没有的，需要自己扩展。这些都是FormWidget。所以就简单说明一下FormWidget的扩展方法。

* 使用create:formwidget创建，即会在插件对应的formwidgets文件里面创建对应创建。
* 所创建的formwidgets文件里面的方法，就不一一介绍了，都在文档里面有。写在这也是抄的。
* 在创建文件中，partials文件即最终渲染到前台的内容。
* assets为配合使用的资源文件




-------------------

# 总结
以上，是头两天学习october的内容，后面有所增减。写完这些内容之后，又在重新梳理一次laraOct的技术特性。突然发现是不是上面的东西都是不对。

因为laraOct特性开头本提到：“系统对OCTCMS前台功能进行了扩展”，“原Backend后台主体功能不变，主要供超级管理员使用”。注意到两个字眼，扩展的是前台的功能，而backend后台不变，是提供给管理员使用的。那么问题来了，根据后面的功能，会有一个前台用户(以下简称用户），用户会有权限，用户是不是可以管理用户的权限，是用户是不是可以配置对应的导航栏？上述功能中的导航栏是指前台用户的导航还有后台用户的导航？如果是前台用户的导航，用户要进行配置，要如何操作？

如果是这样，是不是假想，在前台用户和后台管理系统（原OctoberCMS）之间，还存在一个前台管理系统呢？这样的管理系统，专门给前台用户使用，可以管理用户、管理各种数据表、管理权限、管理导航、管理页面。

如果是这样的一个系统，需要怎么使用modules或plugin扩展呢？

这个东西，让人纠结了两三天。这两天的时间都在研究这种具体的实现方式。

很明显，这个东西不管是使用modules还是plugin都是不好实现的。比如说使用yaml的配置方式。plugin是通过components的方式将内容挂到page上面，从而实现对应功能。这个前台用户怎么通过yaml来配置呢？？？首先plugin的components本身就不支持读取yaml。那就必须先实现yaml的读取和保存。这样一来，其实就是重复写OctoberCMS的backend后台代码，一点也没有重用OctoberCMS的功能！
还有OctoberCMS的FormController和ListController提供了对应的数据列表和数据表单，这部分代码要重用也比较麻烦。

还有就是各种list和form。OctoberCMS的backend提供了一种非常简便的方式。如果这个所谓的前台管理系统，要使用对应的功能，是不是要重新再写一个呢？？连视图利用都要比较折腾。这个时候，会想到类不是可以重用的吗？理论上是可以的。但是OctoberCMS实现了一套自己的autoload机制。并不完全依赖composer。

总之，还是各种纠结。所以不打算纠结下去了。趁着星期一，就把邮件发过来。希望我的理解是错的，没有所谓的“前台管理系统”，不然就上面写的那些特性的实现，应该都是错的了!!!






--------------------------
### 被删除内容的分隔线


根据网站的一些资料，就使用人数来说，WordPress、Drupal的人数最多，特别是WordPress 。国内的帝国、Dede也还有非常多的人用。工作中，也接触过类似thinkcmf的东西。
那么为什么基于OctorberCMS来作为一个框架开发呢？大概原因理解如下：

* WordPress最老牌，最大的优点在于插件丰富，你所能想的应该都有。但历史原因，修改核心代码可能会造成各种插件的无法使用，牵一发而动全身。
* Drupal没有接触过，但根据介绍，一款为改变wordpress的状况而生的东西。安全性、可定制性、性能等方面都要远超WordPress。但是使用和开发的门槛相对高很多。现在，Drupal8中使用了Symfony这款PHP框架，原因是开发者可以更好的遵循MVC的开发模式，并且能使用许多Symfony现成的类库。但是Symfony功能强大，企业级，但是学习成本高。
* 就php框架来说，laravel借鉴了Symfony，功能强大并且更加易用。那么有一款使用laravel开发的cms，为什么不用呢？
* 另外，就github上的stars数量来看，OctoberCMS已经4869了。而Drupal才两千多。
* 作为一个有追求的php程序员，应该学习并使用最先进的php技术，所以laravle以及laravel开发的OctoberCMS应该是个不二的选择。



# 错别字
`http://www.ibiart.com/dev/laraoct/LaraOctTechSpec.html`

`前台用户管理`中`用户信息以及权限进行息管理`。

`可配置功能`中`可配置功能中以自定仪表单`


# 吐槽
OctoberCMS的文档，真心不好读。应该分两种，一种是使用者；一种是开发者。