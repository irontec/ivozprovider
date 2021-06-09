import { action } from 'easy-peasy';
const route = {
  route: '/',

  // actions
  setRoute: action((state: any, route: string) => {
    state.route = route;
  }),
};

export default route;
