Developed a comprehensive Genshin Impact guide full-stack website with an extensive database of characters, weapons, and artifacts. The platform features a full account login system, allowing users to register, upload guides, bookmark, and upvote content, fostering an interactive community. Built using PHP, HTML, CSS, and JavaScript, it serves as a valuable resource for fans.

Project Video: https://www.youtube.com/watch?v=8eJGfjtp28U

Coding Language Used: **PHP, MySQL, HTML, CSS, and JavaScript**.

Initial Stages
Our project stemmed from a shared love of gaming and a particular fascination with Genshin Impact, a highly popular game. We decided to create a comprehensive guide website, leveraging our interests and technical skills to provide valuable insights and resources for the gaming community.

Wireframing
During the wireframing stage, we first discussed the necessary database schemas for the website. We then collaboratively created an ER diagram, understanding that clearly defining our goals and functionalities was crucial before starting front-end and back-end development. We ensured that each function and its related database components were clearly documented to prevent issues during development. This thorough planning helped us align our objectives and streamline the development process.

ER Diagram
![er diagram](https://github.com/user-attachments/assets/766655a5-6d4f-457d-bb58-c27ac424e983)

![data strucuture](https://github.com/user-attachments/assets/cef3c265-62fa-4848-b02d-7fdef885f4fb)

Key Features of the Genshin Impact Game Guide Website

1.Dynamic Front-End Design:

Utilizes HTML, CSS, and JavaScript for a responsive and interactive user interface.
![guidepage_1](https://github.com/user-attachments/assets/eabf4025-5bfd-4c6a-9139-aaa144080912)           ![guide page](https://github.com/user-attachments/assets/c2d9743e-055a-4fb7-9fd2-7a954305fa74)


2.Real-Time Data Updates:

![gif_1](https://github.com/user-attachments/assets/00431ca4-a455-4d56-9b65-48d5e41d3992)

Uses **Ajax** to update page content instantly without refreshing, enhancing user experience. When users filter categories, results are **displayed immediately without needing to refresh the page**.

3.Categorized Browsing:

Allows users to browse and filter characters, weapons, and artifacts by various attributes. For example, users can filter characters by level and rarity, weapons by type (e.g., bows, swords, axes), and artifacts by compatibility with characters. Additionally, in the guide section, users can sort guides by publication date, popularity, or bookmarks. By learning and implementing AJAX in our code, we ensured that users can see the filtered results immediately without needing to refresh the webpage.

4.User Account Registration and Encrypted Password Security:

Provides secure account creation with encrypted password protection. We recognize the importance of password security, so after users set their passwords, we implemented automatic encryption using password_hash. This method enhances the security of user information and helps prevent unauthorized access.
![guidepage_7](https://github.com/user-attachments/assets/bc68eea3-3f79-4221-b4a9-f226f5667678)

5.User Comments, Guides, and Engagement:

Enables users to comment on and write guides for characters and weapons. Users can like and bookmark guides, fostering content engagement and personal curation. This allows users to contribute their own strategies and insights while also supporting and diversifying the guide content by engaging with others' contributions through comments, likes, and bookmarks.

6.Personalized Dashboard:
Displays user activity, including posted guides, liked content, and bookmarks, as well as records of other guides that have been bookmarked. This feature allows users to easily manage their interactions and keep track of the content they find valuable.

