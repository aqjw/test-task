import Full from 'Views/Container/Full'

import JobRoutes from './modules/jobs'

export default {
    path: '/spa',
    component: Full,
    redirect: () => '/spa/jobs',
    children: [
        ...JobRoutes,
    ]
}
