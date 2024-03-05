export default function ActiveCallIcon(): JSX.Element {
  return (
    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 40 40'>
      <rect width='40' height='40' fill='var(--color-primary-tonal)' rx='8' />
      <g fill='var(--color-primary)'>
        <path
          d='M13 8a3 3 0 0 1 3 3a1 1 0 0 0 2 0a5 5 0 0 0-5-5a1 1 0 0 0 0 2Z'
          transform='translate(7, 9)'
        />
        <path
          d='M13 4a7 7 0 0 1 7 7a1 1 0 0 0 2 0a9 9 0 0 0-9-9a1 1 0 0 0 0 2Z'
          transform='translate(7, 9)'
        />
        <path
          d='M5 9.86a18.466 18.466 0 0 0 9.566 9.292l.68.303a3.5 3.5 0 0 0 4.33-1.247l.889-1.324a1 1 0 0 0-.203-1.335l-3.012-2.43a1 1 0 0 0-1.431.183l-.932 1.257a12.14 12.14 0 0 1-5.51-5.511l1.256-.932a1 1 0 0 0 .183-1.431l-2.43-3.012a1 1 0 0 0-1.335-.203l-1.333.894a3.5 3.5 0 0 0-1.237 4.355L5 9.86Z'
          transform='translate(7, 9)'
        />
      </g>
    </svg>
  );
}
