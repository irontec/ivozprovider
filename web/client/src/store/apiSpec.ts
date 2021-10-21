import { action, thunk } from 'easy-peasy';
import ApiClient from 'lib/services/api/ApiClient';
import ApiSpecParser from 'lib/services/api/ApiSpecParser';

const specStore = {
  spec: {},
  loading: false,

  // Actions
  setSpec: action((state: any, spec: any) => {
    sessionStorage.setItem('apiSpec', JSON.stringify(spec));
    state.spec = new ApiSpecParser().parse(spec);
  }),
  setLoading: action((state: any/*, spec: any*/) => {
    state.loading = true;
  }),
  unsetLoading: action((state: any/*, spec: any*/) => {
    state.loading = false;
  }),

  init: thunk(
    // callback thunk
    (actions:any, payload, helpers) => {

      const state: any = helpers.getState();
      if (state.loading) {
        return;
      }

      actions.setLoading();

      return new Promise((resolve, reject) => {

        const storedSpec = sessionStorage.getItem('apiSpec');
        if (storedSpec) {
          actions.setSpec(
            JSON.parse(storedSpec)
          );
          resolve(true);
          return;
        }

        ApiClient.get(
          '/docs.json',
          {},
          async (data: any/*, headers: any*/) => {
            actions.setSpec(data);
            actions.unsetLoading();
            resolve(true);
          }
        ).catch((error: any) => {
          console.log('error', error);
          actions.unsetLoading();
          reject(error)
        });
      });
    },
  )
};

export default specStore;
