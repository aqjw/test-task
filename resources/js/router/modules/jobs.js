const List = () => import ('Views/jobs/List')
const Show = () => import ('Views/jobs/Show')
const SendApplication = () => import ('Views/jobs/SendApplication')


export default [
    {
        path: '/spa/jobs',
        component: List
    }, {
        path: '/spa/jobs/:job_id',
        component: Show,
        props: route => {
            return {job_id: Number(route.params.job_id)}
        }
    }, {
        path: '/spa/jobs/send-application/:job_id',
        component: SendApplication,
        props: route => {
            return {job_id: Number(route.params.job_id)}
        }
    }
]