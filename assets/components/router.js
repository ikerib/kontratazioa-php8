import NotificationList from "./Notification/NotificationList";
import NotificationAdd from "./Notification/NotificationAdd";
import NotificationEdit from "./Notification/NotificationEdit";

export default [
    { path: '/'     , name: 'NotificationList', component: NotificationList },
    { path: '/add'  , name: 'NotificationAdd',  component: NotificationAdd },
    { path: '/aldatu/:id'  , name: 'NotificationEdit',  component: NotificationEdit },
]
