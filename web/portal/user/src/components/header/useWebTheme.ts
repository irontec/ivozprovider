import { useState, useEffect } from 'react';
import { useStoreActions } from 'store';

interface WebTheme {
  logo: string;
  name: string;
  theme: string;
}

const useWebTheme = (): WebTheme => {
  const apiGet = useStoreActions((store) => store.api.get);

  const [webTheme, setWebTheme] = useState<WebTheme>({
    logo: '',
    name: '',
    theme: '',
  });

  useEffect(() => {
    apiGet({
      path: '/my/web_theme',
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
