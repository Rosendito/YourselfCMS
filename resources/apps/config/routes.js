// Examples
import ExampleTemplateApp from '@/components/examples/TemplateApp'

const examplesRoutes = [
	{
		path: '/cms/examples/template',
		name: 'example/template',
		component: ExampleTemplateApp,
	}
]

// Dashboard
import DashboardApp from '@/components/sections/dashboard/DashboardApp'

const dashboardRoutes = [
	{
		path: '/cms/escritorio',
		name: 'dashboard',
		component: DashboardApp,
	}
]

// Articles
import ArticleApp from '@/components/sections/articles/ArticleApp'
import ArticleCreate from '@/components/sections/articles/ArticleCreate'
import ArticleDetail from '@/components/sections/articles/ArticleDetail'
import ArticleEdit from '@/components/sections/articles/ArticleEdit'

const articlesRoutes = [
	{
		path: '/cms/articulos',
		name: 'article',
		component: ArticleApp,
	},
	{
		path: '/cms/articulos/crear',
		name: 'article/create',
		component: ArticleCreate,
	},
	{
		path: '/cms/articulos/:id/detalles',
		name: 'article/detail',
		component: ArticleDetail,
	},,
	{
		path: '/cms/articulos/:id/editar',
		name: 'article/edit',
		component: ArticleEdit,
	},
]

// Categories
import CategoryApp from '@/components/sections/categories/CategoryApp'

const categoriesRoutes = [
	{
		path: '/cms/categorias',
		name: 'category',
		component: CategoryApp,
	}
]

// Tags
import TagApp from '@/components/sections/tags/TagApp'

const tagsRoutes = [
	{
		path: '/cms/etiquetas',
		name: 'tag',
		component: TagApp,
	}
]

// Users
import UserApp from '@/components/sections/users/UserApp'

const usersRoutes = [
	{
		path: '/cms/usuarios',
		name: 'user',
		component: UserApp,
	}
]

// Base
const base = [
	{
		path: '/cms',
		redirect: { name: 'dashboard' }
	}
]

const routes = base.concat(
	examplesRoutes,
	dashboardRoutes,
	articlesRoutes,
	categoriesRoutes,
	tagsRoutes,
	usersRoutes,
)

export default routes