import { useEffect, useState } from 'react';
import { useStoreActions } from 'store';

interface WebTheme {
  logo: string;
  name: string;
  theme: string;
  productName: string;
}

const useWebTheme = (): WebTheme => {
  const apiGet = useStoreActions((store) => store.api.get);

  const [webTheme, setWebTheme] = useState<WebTheme>({
    logo: '',
    name: '',
    theme: '',
    productName: '',
  });

  useEffect(() => {
    apiGet({
      path: '/my/theme',
      params: {},
      successCallback: async (data) => {
        const response = data as WebTheme;

        setWebTheme(response);
      },
    });
  }, [apiGet]);

  return webTheme;
};

export default useWebTheme;
