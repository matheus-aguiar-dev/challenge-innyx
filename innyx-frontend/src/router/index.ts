import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import LoginPage from '../views/LoginPage.vue';
import DashBoard from '../views/DashboardPage.vue';
import Produtos from '../views/ProdutoPage.vue';
import Produto from '../views/ProdutoInfo.vue';
import CreateProduto from '../views/ProductCreate.vue';
import EditProduto from '../views/ProductEdit.vue';
import Categoria from '../views/CategoriaPage.vue';
import EditCategoria from '../views/CategoriaEdit.vue'; // Fixed typo here
import CreateCategoria from '../views/CategoriaCreate.vue'; // Fixed typo here
import ProdutoSearch from '../views/ProdutoSearch.vue'; // Import your component

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'login',
    component: LoginPage
  },
  {
    path: '/DashBoard',
    name: 'dashboard',
    component: DashBoard
  },
  {
    path: '/produtos',
    name: 'produtos',
    component: Produtos
  },
  {
    path: '/produto/:index',
    name: 'produto',
    component: Produto
  },
  {
    path: '/produto/create',
    name: 'produtocreate',
    component: CreateProduto
  },
  {
    path: '/produto/edit/:index',
    name: 'produtoedit',
    component: EditProduto
  },
  {
    path: '/produto/search',
    name: 'produtosearch',
    component: ProdutoSearch,
  },
  {
    path: '/categorias',
    name: 'categorias',
    component: Categoria
  },
  {
    path: '/categoria/edit/:index', 
    name: 'categoriaEdit',
    component: EditCategoria
  },
  {
    path: '/categoria/create',
    name: 'categoriacreate',
    component: CreateCategoria
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});

export default router;

