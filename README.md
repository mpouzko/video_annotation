v 1.6
- when error tiles are removed, grid is rearranged to exclude empty cells. 

v 1.5
- in config section (index.php) you can choose source list from one of .txt files located in script folder. Just add some txt files into script folder to provide additional datasources. 
- some bugfix 

v 1.4.2
- if video url has no http:// prefix, it is added automaticaly. 

v 1.4.1
- feature added: when you click with RMB on tile, target file is opened in a new tab. 

v 1.4
- added performance limit parameter in config
- added video error handling:  bad item is removed from gird, and
  video url is added into textarea at the bottom of the page
- selected video urls are logged into separate textarea at the bottom of
  the page
- added video filename as label for video items in grid
- playing of videos is possible even if not all of them are loaded yet
- input urls list is sanitized to remove blank lines, etc.
