import './styles.css'
import React from 'react'
import { createRoot } from 'react-dom/client'
import { createInertiaApp } from '@inertiajs/react'
import { Layout } from './Layout/Layout'

import * as bootstrap from 'bootstrap'
import { FiltersProvider } from './context/filters'
import { CartProvider } from './context/cart'
import { ProductProvider } from './context/products'
import { AuthProvider } from './context/auth'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true })
    const page = pages[`./Pages/${name}.jsx`]
    page.default.layout = page.default.layout || (page => <Layout>{page}</Layout>)
    return page
  },
  setup({ el, App, props }) {
    createRoot(el).render(
      <React.StrictMode>
        <AuthProvider>
          <FiltersProvider>
            <ProductProvider>
              <CartProvider>
                <App {...props} />
              </CartProvider>
            </ProductProvider>
          </FiltersProvider>
        </AuthProvider>
      </React.StrictMode>
    )
  }
})
